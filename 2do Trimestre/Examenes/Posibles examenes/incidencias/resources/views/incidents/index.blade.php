<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Incidencias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Listado de Incidencias</h3>
                        <a href="{{ url('/incidents/create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                            Nueva Incidencia
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($incidents as $incident)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                <h4 class="font-bold text-xl mb-2">{{ $incident->title }}</h4>
                                <div class="mb-2">
                                    <span class="font-semibold">Prioridad:</span>
                                    <span class="{{ $incident->priority == 'high' ? 'text-red-500 font-bold' : ($incident->priority == 'medium' ? 'text-yellow-500 font-bold' : 'text-green-500 font-bold') }}">
                                        {{ ucfirst($incident->priority) }}
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold">Estado:</span>
                                    <span class="{{ $incident->status ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $incident->status ? 'Resuelta' : 'Pendiente' }}
                                    </span>
                                </div>
                                <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                                    Creado por: {{ $incident->user->name ?? 'N/A' }}
                                </div>
                                <a href="{{ url('/incidents/show/' . $incident->id) }}" class="text-indigo-500 hover:text-indigo-700 font-medium">
                                    Ver detalles &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
