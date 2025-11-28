<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Schedule;
use App\Models\Category;

use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index(Request $request)
{
    $query = User::where('role', 'technician')
        ->with(['services', 'reviews']);

    //  البحث بالاسم أو البريد
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    //  فلترة بالتخصص
    if ($request->filled('specialty')) {
        $query->whereHas('services.category', function ($q) use ($request) {
            $q->where('name', $request->specialty);
        });
    }

    //  فلترة بالمنطقة
    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    //  الفنيين
    $technicians = $query->paginate(3)->withQueryString();

    // التخصصات
    $specialties = Category::whereHas('services.technicians', function ($q) {
        $q->where('role', 'technician');
    })->pluck('name')->unique();

    // المناطق
    $locations   = User::where('role', 'technician')->distinct()->pluck('location');

    return view('admin.technicians.index', compact('technicians' , 'locations' , 'specialties'));
}

public function show($id)
{
    $technician = User::where('role', 'technician')
        ->with([
            'services.category',
            'reviews',
            'schedules',
            'technicianBookings',
        ])
        ->findOrFail($id);

    // إحصائيات الحجوزات
    $totalBookings = $technician->technicianBookings->count();
    $completedBookings = $technician->technicianBookings->where('status', 'completed')->count();
    $pendingBookings = $technician->technicianBookings->where('status', 'pending')->count();

    return view('admin.technicians.show', compact(
        'technician',
        'totalBookings',
        'completedBookings',
        'pendingBookings'
    ));
}



    public function edit($id)
    {
        $technician = User::where('role', 'technician')->findOrFail($id);

        return view('admin.technicians.edit', compact('technician'));
    }

    public function update(Request $request, $id)
{
    $technician = User::where('role', 'technician')->findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'location' => 'required|string',
        'bio' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // تحديث البيانات الأساسية
    $technician->update($request->only([
        'name', 'phone', 'location', 'bio'
    ]));

    // معالجة رفع الصورة
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('users', 'public');
        $technician->image = $path;
        $technician->save();
    }

    return redirect()
        ->route('admin.technicians.show', $technician->id)
        ->with('success', 'تم تحديث بيانات الفني بنجاح');
}



    // إدارة الخدمات التي يقدمها الفني
    public function services($id)
    {
        $technician = User::where('role', 'technician')->with('services')->findOrFail($id);
        $services = Service::with('category')->get();

        return view('admin.technicians.services', compact('technician', 'services'));
    }

    public function attachService(Request $request, $id)
    {
        $technician = User::where('role', 'technician')->findOrFail($id);

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'nullable|numeric',
        ]);

        // نربط مع السعر إذا وُجد
        $attachData = [];
        if ($validated['price'] ?? false) {
            $attachData[$validated['service_id']] = ['price' => $validated['price']];
        } else {
            $attachData[$validated['service_id']] = [];
        }

        $technician->services()->syncWithoutDetaching($attachData);

        return back()->with('success', 'تم إضافة الخدمة للفني');
    }

    public function detachService($id, $serviceId)
    {
        $technician = User::where('role', 'technician')->findOrFail($id);

        $technician->services()->detach($serviceId);

        return back()->with('success', 'تم إزالة الخدمة من الفني');
    }

    public function schedule($id)
    {
        $technician = User::where('role', 'technician')
            ->with('schedules')
            ->findOrFail($id);

        return view('admin.technicians.schedule', compact('technician'));
    }

    public function addSchedule(Request $request, $id)
    {
        $technician = User::where('role', 'technician')->findOrFail($id);

        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Schedule::create([
            'technician_id' => $technician->id,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'is_confirmed' => false,
        ]);

        return back()->with('success', 'تم إضافة الموعد إلى جدولة الفني');
    }

    public function reviews($id)
    {
        $technician = User::where('role', 'technician')->findOrFail($id);

        $reviews = Review::whereHas('booking', function ($q) use ($id) {
            $q->where('technician_id', $id);
        })->with('booking')->get();

        return view('admin.technicians.reviews', compact('technician', 'reviews'));
    }

    public function destroy($id)
{
    $technician = User::where('role', 'technician')->findOrFail($id);

    $technician->services()->detach();
    $technician->schedules()->delete();

    // Booking::where('technician_id', $id)->delete();

    $technician->delete();

    return redirect()->route('admin.technicians.index')
        ->with('success', 'تم حذف الفني بنجاح');
}

}
