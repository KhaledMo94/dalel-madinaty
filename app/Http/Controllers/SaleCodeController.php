<?php

namespace App\Http\Controllers;

use App\Models\SaleCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class SaleCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = SaleCode::withCount(['users', 'validUsers'])->latest()->get();
        return view('admin.codes.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.codes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => ['required', 'string', Rule::unique('sale_codes', 'name')],
            'description_ar'         => 'nullable|string',
            'description_en'         => 'nullable|string',
        ]);

        SaleCode::create([
            'name'                      => $request->name,
            'description'               => [
                'ar'                            => $request->description_ar,
                'en'                            => $request->description_en,
            ],
        ]);

        return redirect()->route('admins.codes.index')
            ->with('success', __('Sales Referral Added'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleCode $saleCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $saleCode = SaleCode::findOrFail($id);
        return view('admin.codes.edit', [
            'code'              => $saleCode,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $saleCode = SaleCode::findOrFail($id);
        $request->validate([
            'name'                  => ['required', 'string', Rule::unique('sale_codes', 'name')->ignore($saleCode->id)],
            'description_ar'         => 'nullable|string',
            'description_en'         => 'nullable|string',
        ]);


        $saleCode->update([
            'name'                      => $request->name,
            'description'               => [
                'ar'                            => $request->description_ar,
                'en'                            => $request->description_en,
            ],
        ]);

        return redirect()->route('admins.codes.index')
            ->with('success', __('Sales Referral Updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $saleCode = SaleCode::findOrFail($id);
        try {
            DB::beginTransaction();
            DB::table('users')->where('sale_code_id', $id)->update([
                'sale_code_id'                      => ""
            ]);
            $saleCode->delete();
            DB::commit();
            return redirect()->route('admins.codes.index')
                ->with('success', __('Sales Referral Deleted'));
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->route('admins.codes.index')
                ->with('error', $th);
        }
    }

    public function search(Request $request)
    {
        $search = "%{$request->query('q')}%";

        $codes = SaleCode::where(function ($query) use ($search) {
            $query->where("name", 'LIKE', $search);
        })->limit(10)->get();

        return response()->json(
            $codes->map(function ($code) {
                return [
                    'id' => $code->id,
                    'name' => $code->name,
                ];
            })
        );
    }
}
