<x-layouts.admin>
    <h1 class="text-2xl font-bold mb-6">إدارة الخدمات</h1>


    <form method="GET" action="{{ route('admin.services.index') }}" class="mb-6 flex flex-wrap gap-4">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="ابحث برقم أو اسم الخدمة..."
        class="w-64 px-4 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600">
    
    <select
        name="category_id"
        class="w-48 px-4 py-2 border pr-10 rounded-lg focus:ring-blue-600">
    
        <option value="" class="text-gray-400" {{ request('category_id') ? '' : 'selected' }}>كل التصنيفات</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (string)request('category_id') === (string)$cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        بحث
    </button>
</form>

    {{-- زر إضافة خدمة جديدة --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.services.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center gap-2">
            <i class="fa-solid fa-plus mr-2"></i> إضافة خدمة جديدة
        </a>
    </div>

    {{-- جدول الخدمات --}}
    <table class="w-full mt-6 border-collapse border border-gray-200">
    <thead class="bg-blue-300">
        <tr>
            <th class="border p-2">#</th>
            <th class="border p-2">الخدمة</th>
            <th class="border p-2">التصنيف</th>
            <th class="border p-2">السعر الأساسي</th>
            <th class="border p-2">عدد الفنيين</th>
            <th class="border p-2">عدد الحجوزات</th>
            <th class="border p-2">الإجراءات</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($services as $service)
            <tr>
                <td class="px-4 py-2">{{ $service->id }}</td>
                <td class="px-4 py-2">{{ $service->name }}</td>
                <td class="px-4 py-2">{{ $service->category->name ?? '—' }}</td>
                <td class="px-4 py-2">{{ $service->base_price }} ر.ي</td>
                <td class="px-4 py-2">{{ $service->technicians_count }}</td>
                <td class="px-4 py-2">{{ $service->bookings_count }}</td>
                <td class="px-4 py-2 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.services.show', $service->id) }}"
                       class="bg-indigo-600 text-white ml-auto px-3 py-1 rounded hover:bg-indigo-700 flex items-center gap-1">
                        <i class="fa-solid fa-eye"></i> تفاصيل
                    </a>
                    <a href="{{ route('admin.services.edit', $service->id) }}"
                       class="bg-yellow-600 text-white ml-auto px-3 py-1 rounded hover:bg-yellow-700 flex items-center gap-1">
                        <i class="fa-solid fa-pen"></i> تعديل
                    </a>
                    <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}"
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

        {{-- روابط الصفحات --}}
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    
</x-layouts.admin>