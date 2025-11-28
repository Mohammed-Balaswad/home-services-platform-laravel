<x-layouts.admin>
    <h1 class="text-2xl font-bold text-blue-900 mb-6">تفاصيل المستخدم</h1>

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6 space-y-6">
        {{-- صورة افتراضية أو أول حرف من الاسم --}}
        <div class="flex items-center gap-4">
        @if($user->image)
        <img src="{{ asset('storage/' . $user->image) }}"
             alt="{{ $user->name }}"
             class="w-16 h-16 rounded-full object-cover border border-gray-300">
    @else
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl font-bold">
            {{ mb_substr($user->name, 0, 1) }}
        </div>
    @endif
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500">#{{ $user->id }}</p>
            </div>
        </div>

        {{-- معلومات أساسية --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-medium text-gray-600">البريد الإلكتروني</h3>
                <p class="text-gray-800">{{ $user->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">رقم الجوال</h3>
                <p class="text-gray-800">{{ $user->phone ?? '—' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">الدور</h3>
                <p class="text-gray-800">{{ ucfirst($user->role) }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">الموقع</h3>
                <p class="text-gray-800">{{ $user->location ?? '—' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">الوصف</h3>
                <p class="text-gray-800">{{ $user->bio ?? 'لا يوجد وصف' }}</p>
            </div>
        <div>
            
        {{-- متوسط التقييم للفني فقط --}}
        @if($user->role === 'technician')
            <h3 class="text-sm font-medium text-gray-600">متوسط التقييمات</h3>
                            <span class="text-gray-800 text-sm">
                    {{ number_format($user->rating_avg, 1) }} / 5
                </span>
            </div>
        @endif
    </div>        

        {{-- الإجراءات --}}
        <div class="flex gap-3">
            <a href="{{ route('admin.users.edit', $user) }}"
               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                تعديل
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    حذف
                </button>
            </form>
        </div>
    </div>
</x-layouts.admin>