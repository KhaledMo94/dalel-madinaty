<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackagePurchaseResource;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Resources\PackageResource;
use App\Models\PackagePurchase;
use App\Models\User;
use Carbon\Carbon;
use App\Services\FawryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    public function index()
    {
        $package = Package::latest('updated_at')->first();
        return new PackageResource($package);
    }

    public function subscribe(FawryService $fawry, Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id'
        ]);

        $user = Auth::guard('sanctum')->user();

        $package = Package::find($request->package_id);
        if (!$package) {
            return response()->json([
                'message' => __('Package not found'),
            ], 404);
        }

        $purchase = PackagePurchase::create([
            'user_id'                   => $user->id,
            'package_id'                => $package->id,
            'paid_amount'               => $package->price,
            'payment_method'            => 'fawry',
            'payment_status'            => 'pending',
        ]);

        $order = [
            'method'                        => 'PAYATFAWRY',
            'customer_name'                 => $user->name,
            'customer_phone'                => $user->phone,
            'customer_email'                => $user->email,
            'total'                         => $package->price,
            'id'                            => $purchase->id,
            'customer_id'                   => $user->id,
            'price'                         => $package->price,
        ];

        $url = $fawry->createInvoice($order);

        return $url;
    }

    public function myPackagePurchases()
    {
        $user = Auth::guard('sanctum')->user();
        return PackagePurchaseResource::collection($user->purchases);
    }

    public function myActivePackagePurchase()
    {
        $user = Auth::guard('sanctum')->user();
        return $user->latestValidPurchase ?
            new PackagePurchaseResource($user->latestValidPurchase) :
            response()->json(['message' => __("You Don't Has Active Purchase !")]);
    }

    public function handleFawryCallback(Request $request)
    {
        Log::info('Received Fawry notification', $request->all());

        $fawryRefNumber         = $request->input('fawryRefNumber');
        $merchantRefNumber      = $request->input('merchantRefNumber');
        $paymentAmount          = number_format($request->input('paymentAmount'), 2, '.', '');
        $orderAmount            = number_format($request->input('orderAmount'), 2, '.', '');
        $orderStatus            = $request->input('orderStatus');
        $paymentMethod          = $request->input('paymentMethod');
        $paymentRefrenceNumber  = $request->input('paymentRefrenceNumber') ?? '';
        $secureKey              = config('services.fawry.secure_key');

        $signatureString = $fawryRefNumber
            . $merchantRefNumber
            . $paymentAmount
            . $orderAmount
            . $orderStatus
            . $paymentMethod
            . $paymentRefrenceNumber
            . $secureKey;

        $generatedSignature = hash('sha256', $signatureString);

        if ($generatedSignature !== $request->input('messageSignature')) {
            Log::warning('invalid signature');
            abort(403, 'Invalid Fawry signature');
        }

        $package = Package::whereHas('purchases', function ($query) use ($merchantRefNumber) {
            $query->where('id', $merchantRefNumber);
        })->first();

        $purchase = PackagePurchase::where('id', $merchantRefNumber)
            ->first();

        if (! $purchase) {

            return response()->json([
                'message'                   => 'order not found'
            ], 401);
        }

        if ($orderStatus == 'PAID') {

            $purchase->update([
                // 'transaction_id'                => $request->fawryRefNumber,
                'start_date'            => Carbon::now(),
                'end_date'               => Carbon::now()->addDays((int)$package->valid_days),
                'payment_status'                => 'paid',
            ]);

            Log::info('package purchases updated successfully');
            return response()->json([
                'message'               => 'successfully updated'
            ], 200);
        }
        return response()->json(
            [
                'message'              => 'error'
            ],
            500
        );
    }
}
