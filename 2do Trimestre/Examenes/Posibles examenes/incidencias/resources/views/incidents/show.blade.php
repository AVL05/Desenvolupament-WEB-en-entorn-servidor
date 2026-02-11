<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Incidencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-3xl font-bold mb-2">{{ $incident->title }}</h3>
                        <p class="text-sm text-gray-500">ID: {{ $incident->id }} | Creado: {{ $incident->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mb-6">
                        <h4 class="text-lg font-semibold mb-2 border-b border-gray-200 dark:border-gray-600 pb-2">Descripción</h4>
                        <p class="text-lg whitespace-pre-wrap">{{ $incident->description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Prioridad</p>
                            <p class="text-xl font-bold {{ $incident->priority == 'high' ? 'text-red-500' : ($incident->priority == 'medium' ? 'text-yellow-500' : 'text-green-500') }}">
                                {{ ucfirst($incident->priority) }}
                            </p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Estado</p>
                            <p class="text-xl font-bold {{ $incident->status ? 'text-green-500' : 'text-red-500' }}">
                                {{ $incident->status ? 'Resuelta' : 'Pendiente' }}
                            </p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Usuario Solicitante</p>
                            <p class="text-xl font-bold">{{ $incident->user->name ?? 'Desconocido' }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ url('/incidents/edit/' . $incident->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                            Editar
                        </a>

                        @if(!$incident->status)
                            <form action="{{ url('/incidents/resolve/' . $incident->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition">
                                    Marcar como resuelta
                                </button>
                            </form>
                        @endif

                        <a href="{{ url('/incidents') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition ml-auto">
                            Volver al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
