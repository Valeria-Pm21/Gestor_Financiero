<x-app-layout>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Bienvenida --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    ¡Hola, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-500 mt-1">
                    Este es el resumen de tu actividad financiera.
                </p>
            </div>

            {{-- Resumen financiero --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                {{-- Saldo total --}}
                <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Saldo total disponible
                            </p>
                            <h3 class="text-2xl font-bold text-[#8652C7] mt-3">
                                ${{ number_format($saldoTotal, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-2">
                                En todas tus cuentas
                            </p>
                        </div>
                        <div class="bg-[#E9D8FF] text-[#8652C7] rounded-lg p-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 2v8m0 0v2m0-2c-1.657 0-3-.895-3-2">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Ingresos --}}
                <div class="bg-white rounded-xl shadow-sm border border-[#D8F5E8] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Ingresos del mes
                            </p>
                            <h3 class="text-2xl font-bold text-[#23996C] mt-3">
                                ${{ number_format($ingresosMes, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-2">
                                Dinero recibido
                            </p>
                        </div>
                        <div class="bg-[#D8F5E8] text-[#23996C] rounded-lg p-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 19V5m-7 7l7-7 7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Gastos --}}
                <div class="bg-white rounded-xl shadow-sm border border-[#FFE0D8] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Gastos del mes
                            </p>
                            <h3 class="text-2xl font-bold text-[#D96D59] mt-3">
                                ${{ number_format($gastosMes, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-2">
                                Dinero gastado
                            </p>
                        </div>
                        <div class="bg-[#FFE0D8] text-[#D96D59] rounded-lg p-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14m7-7l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Accesos rápidos --}}
            <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Accesos rápidos
                </h3>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('transacciones.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#E98BB5] text-white text-sm font-medium rounded-lg hover:bg-[#D978A5] transition">
                        + Nueva transacción
                    </a>

                    <a href="{{ route('cuentas.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#E9D8FF] text-[#7041AC] text-sm font-medium rounded-lg hover:bg-[#DCC5F7] transition">
                        Ver mis cuentas
                    </a>

                    <a href="{{ route('categorias.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#F5D477] text-[#75591B] text-sm font-medium rounded-lg hover:bg-[#EBC65E] transition">
                        Ver categorías
                    </a>
                </div>
            </div>

            {{-- Cuentas y últimas transacciones --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Mis cuentas --}}
                <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Mis cuentas
                        </h3>
                        <a href="{{ route('cuentas.index') }}"
                            class="text-sm text-[#A77BDD] hover:text-[#8652C7] font-medium">
                            Ver todas
                        </a>
                    </div>

                    @forelse ($cuentas as $cuenta)
                        <div class="flex items-center justify-between py-4 border-b border-[#FCEAF1] last:border-0">
                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $cuenta->nombre }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $cuenta->moneda ?? 'COP' }}
                                </p>
                            </div>

                            <p class="font-semibold text-[#8652C7]">
                                ${{ number_format($cuenta->saldo, 0, ',', '.') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 py-6 text-center">
                            Todavía no tienes cuentas registradas.
                        </p>
                    @endforelse
                </div>

                {{-- Últimos movimientos --}}
                <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Últimos movimientos
                        </h3>
                        <a href="{{ route('transacciones.index') }}"
                            class="text-sm text-[#A77BDD] hover:text-[#8652C7] font-medium">
                            Ver todos
                        </a>
                    </div>

                    @forelse ($ultimasTransacciones as $transaccion)
                        <div class="flex items-center justify-between py-4 border-b border-[#FCEAF1] last:border-0">
                            <div class="min-w-0 pr-3">
                                <p class="font-medium text-gray-800 truncate">
                                    {{ $transaccion->categoria->nombre ?? 'Sin categoría' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $transaccion->cuenta->nombre ?? 'Sin cuenta' }}
                                    ·
                                    {{ \Carbon\Carbon::parse($transaccion->fecha)->format('d/m/Y') }}
                                </p>
                            </div>

                            <p class="font-semibold whitespace-nowrap
                                {{ $transaccion->tipo === 'ingreso' ? 'text-[#23996C]' : 'text-[#D96D59]' }}">
                                {{ $transaccion->tipo === 'ingreso' ? '+' : '-' }}${{ number_format($transaccion->monto, 0, ',', '.') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 py-6 text-center">
                            Todavía no tienes transacciones registradas.
                        </p>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
