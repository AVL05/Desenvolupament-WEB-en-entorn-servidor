<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Incidencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ url('/incidents/edit/' . $incident->id) }}" method="POST" class="max-w-2xl">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Título</label>
                            <input type="text" name="title" id="title" value="{{ $incident->title }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                            <textarea name="description" id="description" rows="5" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ $incident->description }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prioridad</label>
                            <select name="priority" id="priority" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="low" {{ $incident->priority == 'low' ? 'selected' : '' }}>Baja</option>
                                <option value="medium" {{ $incident->priority == 'medium' ? 'selected' : '' }}>Media</option>
                                <option value="high" {{ $incident->priority == 'high' ? 'selected' : '' }}>Alta</option>
                            </select>
                        </div>

                        <div class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <label for="status" class="flex items-center cursor-pointer">
                                <input type="checkbox" name="status" id="status" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ $incident->status ? 'checked' : '' }}>
                                <span class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-400">Marcar como resuelta</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                Actualizar
                            </button>
                            <a href="{{ url('/incidents/show/' . $incident->id) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 font-medium">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
