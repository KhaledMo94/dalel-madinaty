<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\MainCategory;
use App\Models\Order;
use App\Models\PackagePurchase;
use App\Models\Offer;
use App\Models\ListingBranch;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics - Exclude admins by checking roles
        $totalUsers = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['admin', 'super-admin']);
        })->count();

        $totalListings = Listing::count();
        $totalOffers = Offer::count();
        $activeOffers = Offer::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();
        $totalCategories = Category::count();
        $totalMainCategories = MainCategory::count();
        $totalBranches = ListingBranch::count();
        $totalRatings = Rating::count();
        $totalComments = Comment::count();
        $totalBanners = Banner::count();

        // Recent Activity (Last 30 days)
        $recentUsers = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['admin', 'super-admin']);
        })->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        $recentListings = Listing::where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        $recentOffers = Offer::where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        // Monthly Growth
        $thisMonthUsers = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['admin', 'super-admin']);
        })->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $lastMonthUsers = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['admin', 'super-admin']);
        })->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $thisMonthListings = Listing::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $lastMonthListings = Listing::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Calculate percentage change
        $userGrowth = $lastMonthUsers > 0
            ? round((($thisMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 1)
            : ($thisMonthUsers > 0 ? 100 : 0);

        $listingGrowth = $lastMonthListings > 0
            ? round((($thisMonthListings - $lastMonthListings) / $lastMonthListings) * 100, 1)
            : ($thisMonthListings > 0 ? 100 : 0);

        // Chart Data - Last 6 months
        $chartLabels = [];
        $chartUsersData = [];
        $chartListingsData = [];
        $chartOffersData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            $chartLabels[] = $monthName;

            // Users count for this month
            $monthUsers = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'super-admin']);
            })->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $chartUsersData[] = $monthUsers;

            // Listings count for this month
            $monthListings = Listing::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $chartListingsData[] = $monthListings;

            // Offers count for this month
            $monthOffers = Offer::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $chartOffersData[] = $monthOffers;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalListings',
            'totalOffers',
            'activeOffers',
            'totalCategories',
            'totalMainCategories',
            'totalBranches',
            'totalRatings',
            'totalComments',
            'totalBanners',
            'recentUsers',
            'recentListings',
            'recentOffers',
            'thisMonthUsers',
            'thisMonthListings',
            'userGrowth',
            'listingGrowth',
            'chartLabels',
            'chartUsersData',
            'chartListingsData',
            'chartOffersData'
        ));
    }
}
