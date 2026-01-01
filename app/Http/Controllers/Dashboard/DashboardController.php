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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.dashboard',
        );
    }
}
