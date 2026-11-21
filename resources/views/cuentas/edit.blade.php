<x-app-layout>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] overflow-hidden">

                <div class="bg-[#F9EDFF] border-b border-[#E9D8FF] px-6 py-4">
                    <h3 class="text-lg font-semibold text-[#7041AC]">
                        Información de la cuenta
                    </h3>
                    <p class="text-sm text-[#9876BC] mt-1">
                        Modifica los campos que deseas actualizar.
                    </p>
                </div>

                <div class="p-6">

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-[#FFE0D8] text-[#D96D59] rounded-xl border border-[#FFD0C4]">
                            <p class="font-semibold mb-2">Revisa los siguientes datos:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('cuentas.update', $cuenta) }}"
                          id="formCuenta">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nombre de la cuenta --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nombre de la cuenta
                                </label>

                                <input type="text"
                                       name="nombre"
                                       value="{{ old('nombre', $cuenta->nombre) }}"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                       required>

                                @error('nombre')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Saldo --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Saldo
                                </label>

                                <input type="text"
                                       id="saldo_visual"
                                       inputmode="decimal"
                                       value="{{ old('saldo', $cuenta->saldo) }}"
                                       placeholder="0,00"
                                       autocomplete="off"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                       required>

                                <input type="hidden" name="saldo" id="saldo">

                                @error('saldo')
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
                                          class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]">{{ old('descripcion', $cuenta->descripcion) }}</textarea>

                                @error('descripcion')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Moneda --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Moneda
                                </label>

                                <input type="text"
                                       name="moneda"
                                       value="{{ old('moneda', $cuenta->moneda) }}"
                                       maxlength="10"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                       required>

                                @error('moneda')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Botones --}}
                        <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-[#FCEAF1]">

                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#E98BB5] text-white font-semibold rounded-lg hover:bg-[#D978A5] transition shadow-sm">
                                Actualizar cuenta
                            </button>

                            <a href="{{ route('cuentas.index') }}"
                               class="px-6 py-2.5 bg-[#E9D8FF] text-[#7041AC] font-semibold rounded-lg hover:bg-[#DCC5F7] transition">
                                Cancelar
                            </a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Formato automático del saldo --}}
    <script>
        const saldoVisual = document.getElementById('saldo_visual');
        const saldoReal = document.getElementById('saldo');
        const formCuenta = document.getElementById('formCuenta');

        function formatearSaldo() {
            let valor = saldoVisual.value;

            valor = valor.replace(/[^\d,]/g, '');

            const partes = valor.split(',');

            let entero = partes[0];
            let decimal = partes.length > 1 ? partes[1] : null;

            entero = entero.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            if (decimal !== null) {
                decimal = decimal.substring(0, 2);
                saldoVisual.value = entero + ',' + decimal;
            } else {
                saldoVisual.value = entero;
            }
        }

        saldoVisual.addEventListener('input', formatearSaldo);

        // Mostrar el saldo existente con separadores de miles.
        formatearSaldo();

        formCuenta.addEventListener('submit', function () {
            let valor = saldoVisual.value;

            valor = valor.replace(/\./g, '');
            valor = valor.replace(',', '.');

            if (valor === '') {
                valor = '0';
            }

            saldoReal.value = valor;
        });
    </script>

</x-app-layout>
