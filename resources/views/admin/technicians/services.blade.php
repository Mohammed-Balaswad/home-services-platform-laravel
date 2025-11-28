<x-layouts.admin>
    <x-slot:heading>خدمات الفني — {{ $technician->name }}</x-slot:heading>

    <div class="mb-6">
        <h3 class="text-lg font-bold mb-3">الخدمات المرتبطة</h3>

        @forelse($technician->services as $svc)
            <div class="flex items-center justify-between bg-white p-3 rounded mb-2">
                <div>
                    <div class="font-semibold">{{ $svc->name }}</div>
                    <div class="text-sm text-gray-500">سعر: {{ $svc->pivot->price ?? $svc->base_price }} ر.ي</div>
                </div>
                <form method="POST" action="{{ route('admin.technicians.services.detach', ['id'=>$technician->id, 'serviceId' => $svc->id]) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">إزالة</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">لا توجد خدمات.</p>
        @endforelse
    </div>

    <div class="bg-white p-4 rounded">
        <h4 class="font-semibold mb-3">إضافة خدمة</h4>
        <form method="POST" action="{{ route('admin.technicians.services.attach', $technician->id) }}" class="flex gap-2">
            @csrf
            <select name="service_id" class="border px-3 py-2 rounded pr-12">
                <option class="hidden" value="" disabled selected>اختر الخدمة</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->category->name ?? '—' }})</option>
                @endforeach
            </select>
            <input name="price" placeholder="سعر اختياري" class="border px-3 py-2 rounded w-40">
            <button class="bg-green-600 text-white px-3 py-2 rounded">إضافة</button>
        </form>
    </div>
</x-layouts.admin>
