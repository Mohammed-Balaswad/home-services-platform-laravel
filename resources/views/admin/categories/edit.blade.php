<x-layouts.admin>
    <x-slot:heading>تعديل الفئة</x-slot:heading>

    <form action="{{ route('admin.categories.update', $category->id) }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold">اسم الفئة:</label>
            <input type="text" name="name"
                   value="{{ $category->name }}"
                   class="w-full mt-2 p-3 border rounded-lg" required>
        </div>

        <div>
            <label class="font-semibold">الأيقونة الحالية:</label>
            <div class="mt-2 mb-4">
                @if($category->icon)
                    <img src="{{ asset('storage/' . $category->icon) }}"
                         class="w-20 h-20 object-contain border rounded-lg">
                @else
                    <p class="text-gray-500">لا توجد أيقونة</p>
                @endif
            </div>

            <label class="font-semibold">استبدال الأيقونة:</label>
            <input type="file" name="icon"
                   class="w-full mt-2 p-2 border rounded-lg">
        </div>

        <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
            تحديث
        </button>

    </form>
</x-layouts.admin>
