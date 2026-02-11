<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Póliza') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('polizas.update', $poliza->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="id_vehiculo" :value="__('Vehículo')" />
                            <select id="id_vehiculo" name="id_vehiculo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">{{ __('Seleccione un vehículo') }}</option>
                                @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ old('id_vehiculo', $poliza->id_vehiculo) == $vehiculo->id ? 'selected' : '' }}>
                                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_vehiculo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tipo" :value="__('Tipo de Póliza')" />
                            <select id="tipo" name="tipo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Todo Riesgo" {{ old('tipo', $poliza->tipo) == 'Todo Riesgo' ? 'selected' : '' }}>Todo Riesgo</option>
                                <option value="Terceros" {{ old('tipo', $poliza->tipo) == 'Terceros' ? 'selected' : '' }}>Terceros</option>
                            </select>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="importe" :value="__('Importe')" />
                            <x-text-input id="importe" class="block mt-1 w-full" type="number" step="0.01" name="importe" :value="old('importe', $poliza->importe)" required />
                            <x-input-error :messages="$errors->get('importe')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="fecha_comienzo" :value="__('Fecha de Comienzo')" />
                            <x-text-input id="fecha_comienzo" class="block mt-1 w-full" type="date" name="fecha_comienzo" :value="old('fecha_comienzo', $poliza->fecha_comienzo)" required />
                            <x-input-error :messages="$errors->get('fecha_comienzo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="fecha_renovacion" :value="__('Fecha de Renovación')" />
                            <x-text-input id="fecha_renovacion" class="block mt-1 w-full" type="date" name="fecha_renovacion" :value="old('fecha_renovacion', $poliza->fecha_renovacion)" required />
                            <x-input-error :messages="$errors->get('fecha_renovacion')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 me-3" href="{{ route('polizas.index') }}">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button>
                                {{ __('Actualizar Póliza') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
