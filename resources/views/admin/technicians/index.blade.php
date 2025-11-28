<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">إدارة الفنيين</h1>
    {{-- شريط البحث والفلترة --}}
    <form method="GET" action="{{ route('admin.technicians.index') }}" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="ابحث بالاسم أو البريد"
               class="relative w-64 px-6 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600">
        
               <div class="relative w-48">
    <select name="specialty"
            class="appearance-none w-full px-4 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600 pr-10">
        <option value="">اختر التخصص</option>
        @foreach($specialties as $specialty)
            <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>
                {{ $specialty }}
            </option>
        @endforeach
    </select>

</div>
            <div class="relative w-48">
              <select name="location"
                      class="appearance-none w-full px-4 py-2 border rounded-lg focus:ring-blue-600 focus:border-blue-600 pr-10">
                  <option value="">اختر المنطقة</option>
                  @foreach($locations as $location)
                      <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                          {{ $location }}
                      </option>
                  @endforeach
              </select>

             </div>

        <button type="submit"
                class="w-32 bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700">
            بحث
        </button>
    </form>

    <div class="flex justify-between mb-5">
        <h2 class="text-xl font-bold text-gray-700">
            عدد الفنيين: {{ $technicians->total() }}
        </h2>
    </div>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($technicians as $tech)
            <div class="bg-white shadow-lg rounded-lg p-5 hover:shadow-xl transition">

                {{-- Header --}}
                <div class="flex items-center gap-4 mb-4">
                    {{-- صورة الفني أو حرف من اسمه --}}
                    @if($tech->image)
                        <img src="{{ asset('storage/' . $tech->image) }}"
                             alt="{{ $tech->name }}"
                             class="w-14 h-14 rounded-full object-cover border border-gray-300">
                    @else
                        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl font-bold">
                            {{ mb_substr($tech->name, 0, 1) }}
                        </div>
                    @endif

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $tech->name }}</h3>
                        <span class="text-sm text-gray-500">
                            {{ $tech->services->pluck('category.name')->unique()->implode(', ') ?: '—' }}
                        </span>
                    </div>
                </div>

                {{-- Info --}}
                <div class="text-gray-700 space-y-1">
                    <p><i class="fa-solid fa-phone mr-1 text-blue-600"></i> {{ $tech->phone }}</p>
                    <p><i class="fa-solid fa-location-dot mr-1 text-red-500"></i> {{ $tech->location }}</p>
                </div>

                <div class="mt-3 border-t pt-3 text-gray-600 text-sm">
                    <p>🛠️ عدد الخدمات: <span class="font-bold">{{ $tech->services->count() }}</span></p>
                    <p>⭐ متوسط التقييم: <span class="font-bold">{{ number_format($tech->rating_avg ?? 0, 1) }}</span></p>
                </div>

                {{-- Actions --}}
                <a href="{{ route('admin.technicians.show', $tech->id) }}"
                   class="mt-4 block text-center bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg transition">
                    عرض التفاصيل
                </a>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $technicians->links() }}
    </div>

</x-layouts.admin>