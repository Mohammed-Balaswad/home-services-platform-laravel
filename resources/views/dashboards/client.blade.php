<x-layout>
    <x-slot:heading>لوحة تحكم العميل</x-slot:heading>

  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-center">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif 

    <div class="text-xl font-bold">مرحباً عميلنا العزيز </div>
</x-layout>
