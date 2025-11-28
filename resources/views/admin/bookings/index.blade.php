<x-layouts.admin>

    <h1 class="text-2xl font-bold mb-6">إدارة الحجوزات</h1>

    {{-- البحث والفلترة --}}
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="ابحث برقم الحجز، العميل، الفني…"
               class="w-64 px-4 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600">

        <select name="status" class="w-48 pr-10 px-4 py-2 border rounded-lg focus:ring-blue-600">
            <option value="">حالة الحجز</option>
            <option value="pending"   {{ request('status')=='pending'?'selected':'' }}>قيد الانتظار</option>
            <option value="accepted"  {{ request('status')=='accepted'?'selected':'' }}>مقبول</option>
            <option value="completed" {{ request('status')=='completed'?'selected':'' }}>مكتمل</option>
            <option value="canceled"  {{ request('status')=='canceled'?'selected':'' }}>ملغي</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            بحث
        </button>
    </form>

    {{-- جدول الحجوزات --}}
        <table class="w-full mt-6 border-collapse border border-gray-200">
            <thead class="bg-blue-300">
                <tr>
                    <th class="border p-3">#</th>
                    <th class="border p-3">العميل</th>
                    <th class="border p-3">الفني</th>
                    <th class="border p-3">الخدمة</th>
                    <th class="border p-3">التاريخ</th>
                    <th class="border p-3">الوقت</th>
                    <th class="border p-3">السعر</th>
                    <th class="border p-3">الحالة</th>
                    <th class="border p-3">إجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-bold">{{ $booking->id }}</td>

                        <td class="p-3">{{ $booking->client->name }}</td>
                        <td class="p-3">{{ $booking->technician->name }}</td>
                        <td class="p-3">{{ $booking->service->name }}</td>

                        <td class="p-3">{{ $booking->date }}</td>
                        <td class="p-3">{{ $booking->time }}</td>

                        <td class="p-3 text-blue-600 font-semibold">
                            {{ $booking->agreed_price }} ر.ي
                        </td>

                        <td class="p-3">
                            <span class="
                                px-3 py-1 rounded-lg text-white
                                @if($booking->status=='pending') bg-yellow-500
                                @elseif($booking->status=='accepted') bg-blue-600
                                @elseif($booking->status=='completed') bg-green-600
                                @else bg-red-600 @endif">
                                {{ $booking->status }}
                            </span>
                        </td>

                        <td class="p-3">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                               class="text-white bg-blue-700 px-3 py-1 rounded hover:bg-blue-800">
                                <i class="fa-solid fa-eye"></i> تفاصيل
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="p-4 text-gray-500">لا توجد حجوزات مسجلة.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>

</x-layouts.admin>
