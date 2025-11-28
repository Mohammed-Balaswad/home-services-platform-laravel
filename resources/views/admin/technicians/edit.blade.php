<x-layouts.admin>
    <x-slot:heading>تعديل بيانات الفني</x-slot:heading>

    <form action="{{ route('admin.technicians.update', $technician->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">الاسم</label>
            <input type="text" name="name" value="{{ $technician->name }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">رقم الهاتف</label>
            <input type="text" name="phone" value="{{ $technician->phone }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">الموقع</label>
            <input type="text" name="location" value="{{ $technician->location }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">الوصف (Bio)</label>
            <textarea name="bio" class="w-full border px-3 py-2 rounded">{{ $technician->bio }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">الصورة الشخصية</label>

            @if($technician->image)
                <img src="{{ asset('storage/' . $technician->image) }}"
                     class="w-20 h-20 rounded-full mb-2 object-cover border">
            @endif

            <input type="file" name="image">
        </div>

        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            حفظ التعديلات
        </button>
    </form>
</x-layouts.admin>
