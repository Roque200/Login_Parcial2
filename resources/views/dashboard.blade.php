<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center gap-4 mb-6">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar"
                                class="w-16 h-16 rounded-full border-2 border-gray-200">
                        @endif
                        <div>
                            <h3 class="text-lg font-bold">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if(Auth::user()->provider)
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-white
                            {{ Auth::user()->provider === 'spotify' ? 'bg-green-500' : 'bg-indigo-500' }}">
                            Autenticado con {{ ucfirst(Auth::user()->provider) }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>