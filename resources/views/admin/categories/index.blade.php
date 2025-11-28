<x-layouts.admin>
<h1 class="text-2xl font-bold mb-6">إدارة الفئات</h1>

{{-- زر إضافة خدمة جديدة --}}
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.categories.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center gap-2">
        <i class="fa-solid fa-plus mr-2"></i> إضافة فئة جديدة
    </a>
</div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($categories as $category)
            <div class="bg-white p-6 rounded-lg shadow flex items-center gap-4">
                
                {{-- صورة الفئة --}}
                @if($category->icon)
                    <img src="{{ asset('storage/' . $category->icon) }}"
                         class="w-16 h-16 object-contain rounded-lg border">
                @else
                    <div class="w-16 h-16 flex items-center justify-center bg-gray-200 rounded-lg">
                        <i class="fa-solid fa-layer-group text-gray-500 text-2xl"></i>
                    </div>
                @endif

                <div class="flex-1">
                    <h3 class="text-lg font-bold">{{ $category->name }}</h3>
                    <p class="text-gray-500 text-sm">
                        {{ $category->services->count() }} خدمة
                    </p>

                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="text-blue-600 hover:text-blue-800">تعديل</a>

                        <form method="POST"
                              action="{{ route('admin.categories.destroy', $category->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:text-red-800"
                                    onclick="return confirm('متأكد أنك تريد حذف الفئة؟')">
                                حذف
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</x-layouts.admin>
