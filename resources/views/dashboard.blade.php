<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" 
                 style="background: linear-gradient(90deg, #800000 0%, #d4af37 100%);">
                <div class="p-8 text-white">
                    <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="opacity-90">University of Mindanao Enrollment System</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-maroon-700" style="border-top-color: #800000;">
                    <p class="text-gray-500 text-sm uppercase font-bold">Status</p>
                    <h3 class="text-2xl font-bold text-gray-800">Officially Enrolled</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-gold-500" style="border-top-color: #d4af37;">
                    <p class="text-gray-500 text-sm uppercase font-bold">Total Balance</p>
                    <h3 class="text-2xl font-bold text-gray-800">₱ 12,450.00</h3>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>