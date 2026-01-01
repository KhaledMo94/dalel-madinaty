<?php

namespace App\Http\Controllers;

use App\Exports\ListingExport;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;
use App\Exports\SalesExport;

class ReportsController extends Controller
{
    public function salesReport(Request $request)
    {
        return view('admin.reports.sales');
    }

    public function exportSales(Request $request)
    {
        $request->validate([
            'sales_codes_ids'                   => 'nullable|array',
            'sales_codes_ids.*'                 => 'exists:sale_codes,id',
            'from'                              => 'required|date',
            'to'                                => 'required|date|after_or_equal:from',
        ]);

        $listings = Listing::with([
            'user.saleCode',
            'category',
            'user.latestValidPurchase'
        ])->withCount([
            'users',
            'amenities',
            'branches',
        ])->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);

        $listings->when($request->filled('sales_codes_ids'), function ($query) use ($request) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->whereIn('id', $request->sales_codes_ids);
            });
        });

        $listings = $listings->get();

        return Excel::download(new SalesExport($listings), 'sales-report.xlsx');
    }

    public function listingReport(Request $request)
    {
        return view('admin.reports.listing');
    }

    public function exportListing(Request $request)
    {
        $request->validate([
            'category_ids'                      => 'nullable|array',
            'category_ids.*'                    => 'exists:categories,id',
            'from'                              => 'required|date',
            'to'                                => 'required|date|after_or_equal:from',
        ]);

        $listings = Listing::with([
            'user.saleCode',
            'category',
            'user.latestValidPurchase'
        ])->withCount([
            'users',
            'amenities',
            'branches',
        ])->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);

        $listings->when($request->filled('category_ids'), function ($query) use ($request) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->whereIn('id', $request->category_ids);
            });
        });

        $listings = $listings->get();

        return Excel::download(new ListingExport($listings), 'sales-report.xlsx');
    }
}
