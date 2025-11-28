<x-layouts.admin>
    <x-slot:heading>
        لوحة التحكم - المشرف
    </x-slot:heading> 

    {{-- Dashboard Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card: عدد العملاء -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-users fa-3x text-green-600 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد العملاء</h3>
            <p class="mt-2 text-2xl font-bold text-green-600">{{ $usersCount }}</p>
        </div>

        <!-- Card: عدد الفنيين -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-user-tie fa-3x text-blue-900 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد الفنيين</h3>
            <p class="mt-2 text-2xl font-bold text-blue-900">{{ $techniciansCount }}</p>
        </div>

        <!-- Card: عدد الخدمات -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-wrench fa-3x text-orange-500 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد الخدمات</h3>
            <p class="mt-2 text-2xl font-bold text-orange-600">{{ $servicesCount }}</p>
        </div>

        <!-- Card: عدد الفئات -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-layer-group fa-3x text-blue-400 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد الفئات</h3>
            <p class="mt-2 text-2xl font-bold text-blue-400">{{ $categoriesCount }}</p>
        </div>

        <!-- Card: عدد الحجوزات -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-calendar-check fa-3x text-sky-600 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد الحجوزات</h3>
            <p class="mt-2 text-2xl font-bold text-sky-600">{{ $bookingsCount }}</p>
        </div>

        <!-- Card: عدد التقييمات -->
        <div class="bg-gray-100 rounded-lg shadow p-6 flex flex-col items-center">
            <i class="fa-solid fa-star-half-stroke fa-3x text-yellow-500 mb-3"></i>
            <h3 class="text-lg font-semibold text-gray-700">عدد التقييمات</h3>
            <p class="mt-2 text-2xl font-bold text-yellow-600">{{ $reviewsCount }}</p>
        </div>
    </div>


</x-layouts.admin>
