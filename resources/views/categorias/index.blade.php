<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Categorías
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('categorias.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Nueva categoría
                </a>

                <table class="w-full mt-6 text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Tipo</th>
                            <th class="py-2">Descripción</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr class="border-t border-gray-200 dark:border-gray-700">
                                <td class="py-2">{{ $categoria->nombre }}</td>
                                <td class="py-2">{{ ucfirst($categoria->tipo) }}</td>
                                <td class="py-2">{{ $categoria->descripcion }}</td>
                                <td class="py-2 flex gap-3">
                                    <a href="{{ route('categorias.edit', $categoria) }}"
                                       class="text-indigo-500 underline">
                                        Editar
                                    </a>

                                    <form method="POST"
                                          action="{{ route('categorias.destroy', $categoria) }}"
                                          onsubmit="return confirm('¿Eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-500 underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center">
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>