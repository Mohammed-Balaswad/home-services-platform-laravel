<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold text-center mb-6">تسجيل الدخول</h2>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-500 transition">
                دخول
            </button>

            <p class="mt-4 text-center text-sm">
                ليس لديك حساب؟  
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                    إنشاء حساب جديد
                </a>
            </p>

        </form>

    </div>

</body>
</html>
