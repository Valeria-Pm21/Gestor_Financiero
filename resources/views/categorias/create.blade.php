<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Registrar categoría
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-gray-100">
                    Datos de la categoría
                </h3>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">Nombre</label>
                        <input type="text" name="nombre"
                               value="{{ old('nombre') }}"
                               class="w-full rounded border-gray-300"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Tipo</label>
                        <select name="tipo" class="w-full rounded border-gray-300" required>
                            <option value="">Seleccione</option>
                            <option value="ingreso" {{ old('tipo') == 'ingreso' ? 'selected' : '' }}>
                                Ingreso
                            </option>
                            <option value="gasto" {{ old('tipo') == 'gasto' ? 'selected' : '' }}>
                                Gasto
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full rounded border-gray-300">{{ old('descripcion') }}</textarea>
                    </div>

                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Guardar
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