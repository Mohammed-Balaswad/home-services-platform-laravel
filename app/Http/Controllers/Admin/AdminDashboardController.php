<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Review;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'usersCount' => User::where('role', 'client')->count(),
            'techniciansCount' => User::where('role', 'technician')->count(),
            'bookingsCount' => Booking::count(),
            'servicesCount' => Service::count(),
            'reviewsCount' => Review::count(),
            'categoriesCount' => Category::count(),
        ]);
    }
}
