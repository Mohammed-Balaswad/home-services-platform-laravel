<x-layouts.admin>
    <x-slot:heading>إضافة فئة جديدة</x-slot:heading>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6">
        @csrf

        <div>
            <label class="font-semibold">اسم الفئة:</label>
            <input type="text" name="name"
                   class="w-full mt-2 p-3 border rounded-lg" required>
        </div>

        <div>
            <label class="font-semibold">أيقونة الفئة (اختياري):</label>
            <input type="file" name="icon"
                   class="w-full mt-2 p-2 border rounded-lg">
        </div>

        <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
            حفظ
        </button>

    </form>
</x-layouts.admin>
