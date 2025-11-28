<x-layouts.admin>
    <x-slot:heading>التقييمات — {{ $technician->name }}</x-slot:heading>

    <div class="bg-white p-4 rounded">
        @forelse($reviews as $r)
            <div class="border-b py-3">
                <div class="flex justify-between">
                    <div>
                        <div class="font-semibold">حجز رقم: {{ $r->booking_id }}</div>
                        <div class="text-sm text-gray-600">{{ $r->comment ?? 'بدون تعليق' }}</div>
                    </div>
                    <div class="text-yellow-500 font-bold">{{ $r->rating }}/5</div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">لا توجد تقييمات.</p>
        @endforelse
    </div>
</x-layouts.admin>
