<x-layouts.admin>
    <x-slot:heading>جدول الفني — {{ $technician->name }}</x-slot:heading>

    <div class="mb-4">
        <h4 class="font-semibold">إضافة موعد</h4>
        <form method="POST" action="{{ route('admin.technicians.schedule.add', $technician->id) }}" class="flex gap-2 items-center">
            @csrf
            <input type="date" name="date" class="border px-3 py-2 rounded">
            <input type="time" name="time" class="border px-3 py-2 rounded">
            <button class="bg-indigo-600 text-white px-3 py-2 rounded">إضافة</button>
        </form>
    </div>

    <div class="bg-white p-4 rounded">
        @forelse($technician->schedules as $s)
            <div class="flex justify-between border-b py-2">
                <div>{{ $s->date }} — {{ $s->time }}</div>
                <div>
                    <span class="text-sm px-2 py-1 rounded {{ $s->is_confirmed ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $s->is_confirmed ? 'مؤكد' : 'غير مؤكد' }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-gray-500">لا يوجد مواعيد.</p>
        @endforelse
    </div>
</x-layouts.admin>
