<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">تفاصيل الحجز #{{ $booking->id }}</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- معلومات العميل --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-3">العميل</h3>
        <p><strong>الاسم:</strong> {{ $booking->client->name }}</p>
        <p><strong>الهاتف:</strong> {{ $booking->client->phone }}</p>
        <p><strong>العنوان:</strong> {{ $booking->client->location }}</p>
    </div>

    {{-- معلومات الفني --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-3">الفني</h3>
        <p><strong>الاسم:</strong> {{ $booking->technician->name }}</p>
        <p><strong>الهاتف:</strong> {{ $booking->technician->phone }}</p>
        <p><strong>التخصص:</strong> 
            {{ $booking->technician->services->pluck('category.name')->unique()->implode(', ') ?: '—' }}
        </p>
    </div>

    {{-- معلومات الحجز --}}
    <div class="bg-white p-6 rounded-lg shadow md:col-span-2">
        <h3 class="text-xl font-bold mb-3">بيانات الحجز</h3>

        <p><strong>الخدمة:</strong> {{ $booking->service->name }}</p>
        <p><strong>التاريخ:</strong> {{ $booking->date }}</p>
        <p><strong>الوقت:</strong> {{ $booking->time }}</p>
        <p><strong>السعر المتفق عليه:</strong> {{ $booking->agreed_price }} ر.ي</p>
        <p><strong>الحالة:</strong> {{ $booking->status }}</p>

        @if($booking->notes)
            <p class="mt-2"><strong>ملاحظات:</strong> {{ $booking->notes }}</p>
        @endif
    </div>

</div>

{{-- أزرار الإجراءات --}}
<div class="mt-6 flex gap-4">

    <a href="{{ route('admin.bookings.edit', $booking->id) }}"
       class="bg-yellow-500 px-4 py-2 rounded text-white hover:bg-yellow-600">
       <i class="pl-1 fa-solid fa-pen"></i> تعديل الحالة
    </a>

    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}">
        @csrf
        @method('DELETE')
        <button
            onclick="return confirm('هل أنت متأكد من حذف الحجز؟')"
            class="bg-red-600 px-4 py-2 rounded text-white hover:bg-red-700">
            <i class="pl-1 fa-solid fa-trash"></i> حذف
        </button>
    </form>

</div>

</x-layouts.admin>
