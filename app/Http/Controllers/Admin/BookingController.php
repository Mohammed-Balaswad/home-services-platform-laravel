<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // عرض كل الحجوزات
    public function index(Request $request)
{
    $status = $request->query('status');
    $search = $request->query('search');

    $bookings = Booking::with(['client', 'technician', 'service'])
        ->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('id', $search) // البحث برقم الحجز
                      ->orWhereHas('client', fn($c) => $c->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('technician', fn($t) => $t->where('name', 'like', "%{$search}%"));
            });
        })
        ->orderBy('id', 'asc')
        ->paginate(15);

    return view('admin.bookings.index', compact('bookings', 'status', 'search'));
}

    // عرض التفاصيل
    public function show($id)
    {
        $booking = Booking::with(['client', 'technician', 'service', 'review'])
            ->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    // تعديل الحالة فقط
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,accepted,completed,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.bookings.show', $id)
            ->with('success', 'تم تحديث حالة الحجز بنجاح');
    }

    // حذف الحجز
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'تم حذف الحجز بنجاح');
    }
}
