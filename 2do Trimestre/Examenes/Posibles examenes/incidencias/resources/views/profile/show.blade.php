<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-16 w-16 bg-indigo-500 rounded-full flex items-center justify-center text-white text-2xl font-bold uppercase">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID de Usuario</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $user->id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Miembro desde</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8">
                        <a href="{{ url('/profile/edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
