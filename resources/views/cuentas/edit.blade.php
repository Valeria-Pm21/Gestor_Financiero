<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar cuenta
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

                <form method="POST" action="{{ route('cuentas.update', $cuenta) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2">Nombre</label>
                        <input type="text" name="nombre"
                               value="{{ old('nombre', $cuenta->nombre) }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full rounded border-gray-300">{{ old('descripcion', $cuenta->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Saldo</label>
                        <input type="number" name="saldo" step="0.01" min="0"
                               value="{{ old('saldo', $cuenta->saldo) }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Moneda</label>
                        <input type="text" name="moneda"
                               value="{{ old('moneda', $cuenta->moneda) }}"
                               maxlength="10"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('cuentas.index') }}"
                       class="ml-2 text-gray-600 underline">
                        Cancelar
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>