<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Category;
use App\Models\Order;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with([
            'user:id,name,phone_number,country_code',
            'serviceProvider:id,name',
            'serviceProviderBranch',
            'cashier'
        ])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function export(Request $request)
    {
        return view('admin.orders.export');
    }

    public function download(Request $request)
    {
        $request->validate([
            'category_ids'                      => 'nullable|array|required_without:service_provider_id',
            'category_ids.*'                    => 'exists:categories,id',
            'service_provider_id'               => 'nullable|required_without:category_ids',
            'branch_id'                         => 'nullable|required_with:service_provider_id|exists:service_provider_branches,id',
            'from'                              => 'required|date',
            'to'                                => 'required|date|after_or_equal:from',
        ]);

        if ($request->filled('service_provider_id')) {
            if (! DB::table('service_provider_branches')
                ->where('id', $request->branch_id)
                ->where('service_provider_id', $request->service_provider_id)
                ->exists()) {
                return redirect()->back()
                    ->with('error', __('This Branch Not Belong To That Service Provider'));
            }
        }

        $orders = Order::whereBetween('created_at', [$request->from, $request->to]);

        if ($request->filled('branch_id')) {
            $orders->when($request->filled('branch_id'), function ($orders) use ($request) {
                return $orders->whereHas('serviceProviderBranch', function ($query) use ($request) {
                    $query->where('id', $request->branch_id);
                });
            });
        } else {
            $orders->when($request->filled('category_ids'), function ($query) use ($request) {
                $query->whereHas('serviceProvider.category', function ($q) use ($request) {
                    $q->whereIn('id', $request->category_ids);
                });
            });
        }
        $orders = $orders->get();
        return Excel::download(new OrderExport($orders), 'orders-report.xlsx');
    }
}
