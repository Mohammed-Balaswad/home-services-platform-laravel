<x-layouts.admin>
    <h1 class="text-2xl font-bold text-blue-900 mb-6">تعديل بيانات المستخدم</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow space-y-6">
        @csrf
        @method('PUT')

        {{-- الاسم --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600 px-4 py-2">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- البريد الإلكتروني --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600 px-4 py-2">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- رقم الجوال --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الجوال</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600 px-4 py-2">
            @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- الموقع --}}
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">الموقع</label>
            <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600 px-4 py-2">
            @error('location')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- الدور --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">الدور</label>
            <select id="role" name="role"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600 px-4 py-2 pr-10">
                <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>عميل</option>
                <option value="technician" {{ old('role', $user->role) == 'technician' ? 'selected' : '' }}>فني</option>
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- زر التحديث --}}
        <div>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                تحديث البيانات
            </button>
        </div>
    </form>
</x-layouts.admin>