<x-layouts.admin>
    <h1 class="text-3xl font-bold mb-8 flex items-center gap-2 text-blue-900">
      تفاصيل الخدمة
    </h1>

     {{-- أزرار التحكم --}}
    <div class="flex justify-end gap-3 mt-8">
        <a href="{{ route('admin.services.edit', $service->id) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
            <i class="fa-solid fa-pen"></i> تعديل
        </a>
        <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}"
              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2">
                <i class="fa-solid fa-trash"></i> حذف
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- بطاقة معلومات الخدمة --}}
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-600"></i> معلومات الخدمة
            </h2>
            <p><span class="font-bold text-gray-700">الاسم:</span> {{ $service->name }}</p>
            <p><span class="font-bold text-gray-700">التصنيف:</span> {{ $service->category->name ?? '—' }}</p>
            <p><span class="font-bold text-gray-700">السعر الأساسي:</span> {{ $service->base_price }} ر.ي</p>
            <p><span class="font-bold text-gray-700">الوصف:</span> {{ $service->description ?? '—' }}</p>
        </div>

        {{-- بطاقة صورة الخدمة --}}
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center justify-center">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-image text-green-600"></i> صورة الخدمة
            </h2>
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" 
                     class="w-48 h-48 rounded-lg object-cover border">
            @else
                <div class="w-48 h-48 bg-gray-200 flex items-center justify-center rounded-lg">
                    <i class="fa-solid fa-image text-gray-400 text-4xl"></i>
                </div>
            @endif
        </div>

        {{-- بطاقة الفنيين --}}
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4 md:col-span-2">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-tie text-purple-600"></i> الفنيون المرتبطون بالخدمة
            </h2>
            @if($service->technicians->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($service->technicians as $tech)
                        <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <h3 class="font-bold text-gray-800">{{ $tech->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $tech->email }}</p>
                            <p class="mt-2 text-blue-700 font-semibold">
                                السعر: {{ $tech->pivot->price ?? ($service->base_price) }} ر.ي
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">لا يوجد فنيون مرتبطون بهذه الخدمة حالياً.</p>
            @endif
        </div>

        {{-- بطاقة الحجوزات --}}
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4 md:col-span-2">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-red-600"></i> الحجوزات المرتبطة بالخدمة
            </h2>
            @if($service->bookings->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($service->bookings as $booking)
                        <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <h3 class="font-bold text-gray-800">المستخدم: {{ $booking->user->name ?? '—' }}</h3>
                            <p class="text-sm text-gray-600">التاريخ: {{ $booking->date }}</p>
                            <p class="mt-2 text-green-700 font-semibold">الحالة: {{ $booking->status }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">لا توجد حجوزات لهذه الخدمة حالياً.</p>
            @endif
        </div>
    </div>

   
</x-layouts.admin>