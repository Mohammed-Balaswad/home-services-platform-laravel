<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\User;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->query('search');
    $categoryId = $request->query('category_id');

    // نجيب التصنيفات للفورم
    $categories = Category::select('id', 'name')->orderBy('name')->get();

    $services = Service::withCount(['technicians', 'bookings'])
        ->with('category')
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%");
            });
        })
        ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
        ->orderBy('id', 'asc')
        ->paginate(10)
        ->withQueryString(); // يحافظ على باراميترات البحث بين صفحات الترقيم

    return view('admin.services.index', compact('services', 'categories', 'search', 'categoryId'));
    }


    public function create()
    {   
    $categories = Category::all();
    $technicians = User::where('role', 'technician')->get();
    return view('admin.services.create', compact('categories', 'technicians'));
    }

    public function show($id)
    {
    $service = Service::with(['category', 'technicians', 'bookings'])->findOrFail($id);
    return view('admin.services.show', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        
        $data = $request->only(['name', 'description', 'category_id', 'base_price']);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        
         // ريط الفنيين بالخدمة
        $service = Service::create($data);
        if ($request->has('technicians')) {
            $service->technicians()->attach($request->technicians);
        }
        return redirect()->route('admin.services.index')->with('success', 'تم إنشاء الخدمة بنجاح');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();
        $technicians = User::where('role', 'technician')->get();
        return view('admin.services.edit', compact('service', 'categories', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        
        $data = $request->only(['name', 'description', 'category_id', 'base_price']);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        
        $service->update($data);

        // تحديث الفنيين المرتبطين
        if ($request->has('technicians')) {
            $service->technicians()->sync($request->technicians);
        } else {
            $service->technicians()->detach(); 
        }
    
        return redirect()->route('admin.services.index')->with('success', 'تم تحديث بيانات الخدمة بنجاح');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
