<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Vehículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="matricula" :value="__('Matrícula')" />
                            <x-text-input id="matricula" class="block mt-1 w-full" type="text" name="matricula" :value="old('matricula')" required />
                            <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="marca" :value="__('Marca')" />
                            <x-text-input id="marca" class="block mt-1 w-full" type="text" name="marca" :value="old('marca')" required />
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="modelo" :value="__('Modelo')" />
                            <x-text-input id="modelo" class="block mt-1 w-full" type="text" name="modelo" :value="old('modelo')" required />
                            <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="anyo_fab" :value="__('Año de Fabricación')" />
                            <x-text-input id="anyo_fab" class="block mt-1 w-full" type="number" name="anyo_fab" :value="old('anyo_fab')" required />
                            <x-input-error :messages="$errors->get('anyo_fab')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto')" />
                            <input id="foto" type="file" name="foto" class="block mt-1 w-full" accept="image/*" required />
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 me-3" href="{{ route('vehicles.index') }}">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button>
                                {{ __('Guardar Vehículo') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
