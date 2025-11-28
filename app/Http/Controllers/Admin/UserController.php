<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');
    $role   = $request->query('role'); // فلترة حسب الدور (عميل / فني)

    $users = User::where('role', '!=', 'admin')
        ->when($role, fn($q) => $q->where('role', $role))
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('id', $search) // البحث برقم المستخدم
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'asc')
        ->paginate(15);

    return view('admin.users.index', compact('users', 'search', 'role'));
}

    // عرض فورم إضافة مستخدم
    public function create()
    {
        return view('admin.users.create');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error' , 'المستخدم غير موجود');
        }
        
        return view('admin.users.show' , ['user' => $user]);
    }

    // حفظ مستخدم جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'role'     => 'required|in:admin,technician,client',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // عرض فورم التعديل
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // حفظ التعديل
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'role'     => 'required|in:admin,technician,client',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث بيانات المستخدم');
    }

    // حذف المستخدم
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
