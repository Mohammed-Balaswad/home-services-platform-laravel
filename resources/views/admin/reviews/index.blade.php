<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">إدارة التقييمات</h1>

{{-- Filters --}}
<form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    
    <select name="rating" class="border rounded-lg pr-10 px-3 py-2">
        <option value="">التقييم</option>
        @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>

    <select name="technician_id" class="border rounded-lg pr-10 px-3 py-2">
        <option value="">الفني</option>
        @foreach($technicians as $tech)
            <option value="{{ $tech->id }}" {{ request('technician_id') == $tech->id ? 'selected' : '' }}>
                {{ $tech->name }}
            </option>
        @endforeach
    </select>

    <select name="client_id" class="border rounded-lg pr-10 px-3 py-2">
        <option value="">العميل</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    </select>

    <select name="service_id" class="border rounded-lg pr-10 px-3 py-2">
        <option value="">الخدمة</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                {{ $service->name }}
            </option>
        @endforeach
    </select>

    <button
        class="bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 col-span-full md:col-span-1">
        بحث
    </button>
</form>

{{-- Table --}}
    <table class="w-full mt-6 border-collapse border border-gray-200">
        <thead class="bg-blue-300">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">التقييم</th>
                <th class="border p-2">العميل</th>
                <th class="border p-2">الفني</th>
                <th class="border p-2">الخدمة</th>
                <th class="border p-2">التعليق</th>
                <th class="border p-2">التاريخ</th>
                <th class="border p-2">إجراءات</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach($reviews as $review)
                <tr>
                    <td class="py-2 px-3">{{ $review->id }}</td>

                    <td class="py-2 px-3 flex items-center gap-1 text-yellow-600">
                        <i class="fa-solid fa-star"></i> {{ $review->rating }}
                    </td>

                    <td class="py-2 px-3">{{ $review->booking->client->name }}</td>

                    <td class="py-2 px-3">{{ $review->booking->technician->name }}</td>

                    <td class="py-2 px-3">{{ $review->booking->service->name }}</td>

                    <td class="py-2 px-3 text-gray-600">
                        {{ Str::limit($review->comment, 40) ?: '—' }}
                    </td>

                    <td class="py-2 px-3">{{ $review->created_at->format('Y-m-d') }}</td>

                    <td class="px-4 py-2 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.reviews.show', $review->id) }}"
                       class="bg-indigo-600 text-white ml-auto px-3 py-1 rounded hover:bg-indigo-700 flex items-center gap-1">
                        <i class="fa-solid fa-eye"></i> تفاصيل
                    </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


{{-- Pagination --}}
<div class="mt-6">
    {{ $reviews->links() }}
</div>

</x-layouts.admin>
