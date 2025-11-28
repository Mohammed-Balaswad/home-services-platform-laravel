<x-layouts.admin>
    <x-slot:heading>إضافة خدمة جديدة</x-slot:heading>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">اسم الخدمة</label>
                <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">الوصف</label>
                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">التصنيف</label>
                <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
    <label class="block text-sm font-medium text-gray-700">الفنيون المرتبطون بالخدمة</label>
    <select name="technicians[]" multiple
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        @foreach($technicians as $tech)
            <option value="{{ $tech->id }}">{{ $tech->name }}</option>
        @endforeach
    </select>
    <p class="text-xs text-blue-700 mt-1">يمكنك اختيار فني واحد أو أكثر</p>
</div>

            <div>
                <label class="block text-sm font-medium text-gray-700">السعر الأساسي</label>
                <input type="number" step="0.01" name="base_price" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">الصورة</label>
                <input type="file" name="image" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    <i class="fa-solid fa-check mr-2"></i> حفظ الخدمة
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>