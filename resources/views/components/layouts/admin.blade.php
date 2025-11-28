<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - المشرف</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    
    {{-- Sidebar --}}
    <aside class="fixed top-0 right-0 h-screen w-64 bg-blue-900 text-white p-6">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-8">
            <i class="fa-solid fa-user-shield"></i> المشرف
        </h2>

        <nav class="flex flex-col gap-2">
            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                <i class="fa-solid fa-chart-line mr-2"></i> لوحة التحكم
            </x-nav-link>

            <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                <i class="fa-solid fa-users mr-2"></i> المستخدمين
            </x-nav-link>

            <x-nav-link href="{{ route('admin.technicians.index') }}" :active="request()->routeIs('admin.technicians.*')">
                <i class="fa-solid fa-user-tie mr-2"></i> الفنيين
            </x-nav-link>

            <x-nav-link href="{{ route('admin.services.index') }}" :active="request()->routeIs('admin.services.*')">
                <i class="fa-solid fa-wrench mr-2"></i> الخدمات
            </x-nav-link>

            <x-nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')">
                 <i class="fa-solid fa-layer-group mr-2"></i> الفئات
            </x-nav-link>

            <x-nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.*')">
                <i class="fa-solid fa-calendar-check mr-2"></i> الحجوزات
            </x-nav-link>

            <x-nav-link href="{{ route('admin.reviews.index') }}" :active="request()->routeIs('admin.reviews.*')">
                <i class="fa-solid fa-star-half-stroke mr-2"></i> التقييمات
            </x-nav-link>
        </nav>
    </aside>
    
    {{-- Main --}}
    <main class="ml-0 mr-64 p-6">
        {{-- Header --}}

       @if ($errors->has('access'))
    <div class="bg-red-600 border border-red-600 text-white mb-5 px-4 py-3 rounded-lg text-center">
        <p>{{ $errors->first('access') }}</p>
    </div>
@endif
        <header class="bg-white shadow rounded-lg p-4 flex justify-between items-center mb-6">
            <div class="font-semibold text-gray-700">مرحبًا، {{ Auth::user()->name }}</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> تسجيل خروج
                </button>
            </form>
        </header>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 font-bold">
                {{ session('error') }}
            </div>
        @endif

        {{-- Content slot --}}
        <section class="bg-white rounded-lg shadow p-6">
            {{ $slot }}
        </section>
    </main>

</body>
</html>