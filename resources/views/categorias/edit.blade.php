<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar categoría
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('categorias.update', $categoria) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2">Nombre</label>
                        <input type="text" name="nombre"
                               value="{{ old('nombre', $categoria->nombre) }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Tipo</label>
                        <select name="tipo" class="w-full rounded border-gray-300" required>
                            <option value="ingreso"
                                {{ old('tipo', $categoria->tipo) == 'ingreso' ? 'selected' : '' }}>
                                Ingreso
                            </option>
                            <option value="gasto"
                                {{ old('tipo', $categoria->tipo) == 'gasto' ? 'selected' : '' }}>
                                Gasto
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full rounded border-gray-300">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    </div>

                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('categorias.index') }}"
                       class="ml-2 text-gray-600 underline">
                        Cancelar
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>