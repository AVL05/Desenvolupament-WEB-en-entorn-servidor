<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-4">
                        <form method="GET" action="{{ route('vehicles.index') }}">
                            <x-text-input id="matricula" class="block w-full mb-2" type="text" name="matricula" :value="request('matricula')" placeholder="Buscar por matrícula..." />
                            <x-primary-button>
                                {{ __('Buscar') }}
                            </x-primary-button>
                        </form>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('vehicles.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Nuevo Vehículo') }}
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año Fab.</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Editar</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->foto)
                                            <img src="{{ $vehicle->foto }}" alt="Foto" class="h-10 w-10">
                                        @else
                                            <span class="text-gray-400">Sin foto</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->matricula }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->marca }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->modelo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->anyo_fab }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>
                                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vehículo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
