<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">تعديل حالة الحجز #{{ $booking->id }}</h1>

<div class="bg-white p-6 rounded-lg shadow">

    <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">
        @csrf
        @method('PUT')

        <label class="block font-semibold mb-2">الحالة:</label>
        <select name="status"
                class="w-64 px-4 py-2 border rounded-lg pr-10 focus:ring-blue-600 mb-4">
            <option value="pending"   {{ $booking->status=='pending'?'selected':'' }}>قيد الانتظار</option>
            <option value="accepted"  {{ $booking->status=='accepted'?'selected':'' }}>مقبول</option>
            <option value="completed" {{ $booking->status=='completed'?'selected':'' }}>مكتمل</option>
            <option value="canceled"  {{ $booking->status=='canceled'?'selected':'' }}>ملغي</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            تحديث
        </button>

    </form>

</div>

</x-layouts.admin>
