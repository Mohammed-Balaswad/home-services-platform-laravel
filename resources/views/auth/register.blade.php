<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold text-center mb-6">إنشاء حساب جديد</h2>

        @if ($errors->any())
            <div class="bg-red-100 p-3 rounded text-sm text-red-700 mb-4">
                <ul class="list-disc px-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">الاسم الكامل</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">رقم الهاتف</label>
                <input type="text" name="phone" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">المنطقة</label>
                <input type="text" name="location" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">
                إنشاء الحساب
            </button>

            <p class="mt-4 text-center text-sm">
                لديك حساب؟  
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">تسجيل الدخول</a>
            </p>

        </form>

    </div>

</body>
</html>
