<x-layouts.admin>
        <h1 class="text-2xl font-bold mb-6">إدارة المستخدمين</h1>


        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex flex-wrap gap-4">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="ابحث برقم المستخدم، الاسم، البريد…"
           class="w-64 px-4 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600">

    <select name="role" class="w-48 pr-10 px-4 py-2 border rounded-lg focus:ring-blue-600">
        <option value="">كل الأدوار</option>
        <option value="client" {{ request('role')=='client'?'selected':'' }}>عميل</option>
        <option value="technician" {{ request('role')=='technician'?'selected':'' }}>فني</option>
    </select>

    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        بحث
    </button>
</form>



    {{-- زر إضافة خدمة جديدة --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.users.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center gap-2">
            <i class="fa-solid fa-plus mr-2"></i>إضافة مستخدم جديد
        </a>
    </div>

        <table class="w-full mt-6 border-collapse border border-gray-200">
            <thead class="bg-blue-300">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">الاسم</th>
                    <th class="border p-2">البريد</th>
                    <th class="border p-2">الهاتف</th>
                    <th class="border p-2">الدور</th>
                    <th class="border p-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->phone ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $user->role }}</td>
                    <td class="px-4 py-2 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.users.show', $user->id) }}"
                       class="bg-indigo-600 text-white ml-auto px-3 py-1 rounded hover:bg-indigo-700 flex items-center gap-1">
                        <i class="fa-solid fa-eye"></i> تفاصيل
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="bg-yellow-600 text-white ml-auto px-3 py-1 rounded hover:bg-yellow-700 flex items-center gap-1">
                        <i class="fa-solid fa-pen"></i> تعديل
                    </a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                          onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white ml-auto px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1">
                            <i class="fa-solid fa-trash"></i> حذف
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

</div>
        
    </div>
</x-layouts.admin>