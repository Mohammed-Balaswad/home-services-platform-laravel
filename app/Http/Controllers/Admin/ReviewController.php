<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with(['booking.client', 'booking.technician', 'booking.service'])
            ->when($request->rating, fn($q) => $q->where('rating', $request->rating))
            ->when($request->technician_id, fn($q) => 
                $q->whereHas('booking', fn($b) => $b->where('technician_id', $request->technician_id)))
            ->when($request->client_id, fn($q) => 
                $q->whereHas('booking', fn($b) => $b->where('client_id', $request->client_id)))
            ->when($request->service_id, fn($q) => 
                $q->whereHas('booking', fn($b) => $b->where('service_id', $request->service_id)))
            ->latest()
            ->paginate(12);

        return view('admin.reviews.index', [
            'reviews' => $reviews,
            'technicians' => User::where('role', 'technician')->get(),
            'clients' => User::where('role', 'client')->get(),
            'services' => Service::all(),
        ]);
    }

    public function show($id)
    {
        $review = Review::with(['booking.client', 'booking.technician', 'booking.service'])
            ->findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();

        return back()->with('success', 'تم حذف التقييم بنجاح.');
    }
}
