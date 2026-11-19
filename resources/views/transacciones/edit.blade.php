
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar transacción
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form action="{{ route('transacciones.update', $transaccion) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Cuenta</label>
                        <select name="cuenta_id" class="w-full border-gray-300 rounded-md" required>
                            @foreach ($cuentas as $cuenta)
                                <option value="{{ $cuenta->id }}"
                                    {{ old('cuenta_id', $transaccion->cuenta_id) == $cuenta->id ? 'selected' : '' }}>
                                    {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cuenta_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Tipo</label>
                        <select name="tipo" class="w-full border-gray-300 rounded-md" required>
                            <option value="ingreso"
                                {{ old('tipo', $transaccion->tipo) == 'ingreso' ? 'selected' : '' }}>
                                Ingreso
                            </option>
                            <option value="gasto"
                                {{ old('tipo', $transaccion->tipo) == 'gasto' ? 'selected' : '' }}>
                                Gasto
                            </option>
                        </select>
                        @error('tipo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Categoría</label>
                        <select name="categoria_id" class="w-full border-gray-300 rounded-md" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $transaccion->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }} ({{ ucfirst($categoria->tipo) }})
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Monto</label>
                        <input type="number" name="monto" step="0.01" min="0.01"
                               value="{{ old('monto', $transaccion->monto) }}"
                               class="w-full border-gray-300 rounded-md" required>
                        @error('monto')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Fecha</label>
                        <input type="date" name="fecha"
                               value="{{ old('fecha', $transaccion->fecha) }}"
                               class="w-full border-gray-300 rounded-md" required>
                        @error('fecha')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="w-full border-gray-300 rounded-md">{{ old('descripcion', $transaccion->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Actualizar transacción
                        </button>

                        <a href="{{ route('transacciones.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
