<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">تفاصيل التقييم</h1>

<div class="bg-white shadow rounded-lg p-6">

    <div class="flex items-center gap-3 mb-4">
        <span class="text-yellow-500 text-3xl">⭐ {{ $review->rating }}</span>
        <h2 class="text-xl font-bold">تقييم من {{ $review->booking->client->name }}</h2>
    </div>

    <p class="text-gray-700 mb-4">{{ $review->comment }}</p>

    <div class="border-t pt-4 text-gray-600">
        <p><strong>الفني:</strong> {{ $review->booking->technician->name }}</p>
        <p><strong>الخدمة:</strong> {{ $review->booking->service->name }}</p>
        <p><strong>موعد الحجز:</strong> {{ $review->booking->date }} - {{ $review->booking->time }}</p>
    </div>

    <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" class="mt-6">
        @csrf
        @method('DELETE')
        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
            حذف التقييم
        </button>
    </form>

</div>

</x-layouts.admin>
