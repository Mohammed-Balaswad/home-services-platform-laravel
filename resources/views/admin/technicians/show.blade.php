<x-layouts.admin>
    <x-slot:heading>تفاصيل الفني</x-slot:heading>

    {{-- القسم الأول — معلومات أساسية --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center gap-6">

            {{-- صورة الفني --}}
            @if($technician->image)
                <img src="{{ asset('storage/' . $technician->image) }}"
                     alt="{{ $technician->name }}"
                     class="w-20 h-20 rounded-full object-cover border border-gray-300">
            @else
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 text-3xl font-bold">
                    {{ mb_substr($technician->name, 0, 1) }}
                </div>
            @endif

            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $technician->name }}</h2>

                <p class="text-gray-600 mt-1">📧 {{ $technician->email }}</p>
                <p class="text-gray-600">📞 {{ $technician->phone }}</p>
                <p class="text-gray-600">📍 {{ $technician->location }}</p>
            </div>
        </div>
    </div>
    <div class="flex gap-4 mb-6">

    {{-- أزرار الإدارة --}}
    <a href="{{ route('admin.technicians.services', $technician->id) }}"
   class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
    <i class="fa-solid fa-wrench mr-2"></i> إدارة الخدمات
</a>

<a href="{{ route('admin.technicians.schedule', $technician->id) }}"
   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
    <i class="fa-solid fa-calendar-days mr-2"></i> جدول المواعيد
</a>

<a href="{{ route('admin.technicians.reviews', $technician->id) }}"
   class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
    <i class="fa-solid fa-star mr-2"></i> التقييمات
</a>

    <a href="{{ route('admin.technicians.edit', $technician->id) }}"
       class="bg-gray-700 text-white mr-auto px-4 py-2 rounded-lg hover:bg-gray-800">
        <i class="fa-solid fa-pen mr-2"></i> تعديل البيانات
    </a>

    <form method="POST" action="{{ route('admin.technicians.destroy', $technician->id) }}"
          onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
        @csrf @method('DELETE')
        <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            <i class="fa-solid fa-trash mr-2"></i> حذف الفني
        </button>
    </form>

</div>

    {{-- القسم الثاني — إحصائيات --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-50 p-6 rounded-lg shadow text-center">
            <p class="text-lg font-semibold text-gray-700">إجمالي الطلبات</p>
            <p class="text-2xl font-bold text-blue-700">{{ $totalBookings }}</p>
        </div>

        <div class="bg-green-50 p-6 rounded-lg shadow text-center">
            <p class="text-lg font-semibold text-gray-700">مكتملة</p>
            <p class="text-2xl font-bold text-green-700">{{ $completedBookings }}</p>
        </div>

        <div class="bg-yellow-50 p-6 rounded-lg shadow text-center">
            <p class="text-lg font-semibold text-gray-700">منتظرة</p>
            <p class="text-2xl font-bold text-yellow-700">{{ $pendingBookings }}</p>
        </div>
    </div>

    {{-- القسم الثالث — الخدمات --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">الخدمات المقدمة</h3>

        @forelse($technician->services as $service)
            <div class="flex justify-between border-b py-2">
                <span>{{ $service->name }} ({{ $service->category->name ?? '—' }})</span>
                <span class="text-gray-700 font-semibold">
                    {{ $service->pivot->price ?? $service->base_price }} ر.ي
                </span>
            </div>
        @empty
            <p class="text-gray-500">لا توجد خدمات مرتبطة بالفني.</p>
        @endforelse
    </div>

    {{-- القسم الرابع — التقييمات --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">التقييمات</h3>

        @forelse($technician->reviews as $review)
            <div class="border-b py-2 flex items-center">
                ⭐ <span class="font-semibold">{{ $review->rating }}</span> — {{ $review->comment }}
            </div>
        @empty
            <p class="text-gray-500">لا توجد تقييمات.</p>
        @endforelse
    </div>

    {{-- القسم الخامس — جدول العمل --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">جدول الفني</h3>

        @forelse($technician->schedules as $schedule)
            <div class="border-b py-2">{{ $schedule->date }}</div>
        @empty
            <p class="text-gray-500">لا يوجد جدول عمل.</p>
        @endforelse
    </div>

</x-layouts.admin>
