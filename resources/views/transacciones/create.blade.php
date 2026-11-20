
<x-app-layout>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">


            <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] overflow-hidden">

                {{-- Encabezado del formulario --}}
                <div class="bg-[#F9EDFF] border-b border-[#E9D8FF] px-6 py-4">
                    <h3 class="text-lg font-semibold text-[#7041AC]">
                        Registrar movimiento financiero
                    </h3>
                    <p class="text-sm text-[#9876BC] mt-1">
                        Completa los datos para registrar tu nuevo ingreso o gasto.
                    </p>
                </div>

                <div class="p-6">

                    {{-- Errores de validación --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-[#FFE0D8] text-[#D96D59] rounded-xl border border-[#FFD0C4]">
                            <p class="font-semibold mb-2">
                                Revisa los siguientes datos:
                            </p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('transacciones.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Cuenta --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Cuenta
                                </label>

                                <select name="cuenta_id"
                                        class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                        required>
                                    <option value="">Selecciona una cuenta</option>

                                    @foreach ($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id }}"
                                            {{ old('cuenta_id') == $cuenta->id ? 'selected' : '' }}>
                                            {{ $cuenta->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('cuenta_id')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tipo --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tipo de transacción
                                </label>

                                <select name="tipo"
                                        class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                        required>
                                    <option value="">Selecciona el tipo</option>
                                    <option value="ingreso"
                                        {{ old('tipo') == 'ingreso' ? 'selected' : '' }}>
                                        Ingreso
                                    </option>
                                    <option value="gasto"
                                        {{ old('tipo') == 'gasto' ? 'selected' : '' }}>
                                        Gasto
                                    </option>
                                </select>

                                @error('tipo')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Categoría --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Categoría
                                </label>

                                <select name="categoria_id"
                                        class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                        required>
                                    <option value="">Selecciona una categoría</option>

                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }} ({{ ucfirst($categoria->tipo) }})
                                        </option>
                                    @endforeach
                                </select>

                                @error('categoria_id')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Monto --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Monto
                                </label>

                                <input type="number"
                                       name="monto"
                                       step="0.01"
                                       min="0.01"
                                       value="{{ old('monto') }}"
                                       placeholder="Ej. 150000"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                       required>

                                @error('monto')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Fecha --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Fecha
                                </label>

                                <input type="date"
                                       name="fecha"
                                       value="{{ old('fecha', date('Y-m-d')) }}"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                       required>

                                @error('fecha')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Descripción --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Descripción
                                </label>

                                <textarea name="descripcion"
                                          rows="3"
                                          placeholder="Escribe una descripción del movimiento..."
                                          class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD] placeholder-gray-400">{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Botones --}}
                        <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-[#FCEAF1]">

                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#E98BB5] text-white font-semibold rounded-lg hover:bg-[#D978A5] transition shadow-sm">
                                Guardar transacción
                            </button>

                            <a href="{{ route('transacciones.index') }}"
                               class="px-6 py-2.5 bg-[#E9D8FF] text-[#7041AC] font-semibold rounded-lg hover:bg-[#DCC5F7] transition">
                                Cancelar
                            </a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
