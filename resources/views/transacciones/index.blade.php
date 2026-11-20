
<x-app-layout>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Título de la sección --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    Tus movimientos financieros
                </h3>
                <p class="text-gray-500 mt-1">
                    Aquí puedes revisar los ingresos y gastos registrados en tus cuentas.
                </p>
            </div>

            {{-- Mensajes --}}
            @if (session('success'))
                <div class="mb-5 p-4 bg-[#D8F5E8] text-[#23996C] rounded-xl border border-[#BCEBD4]">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 p-4 bg-[#FFE0D8] text-[#D96D59] rounded-xl border border-[#FFD0C4]">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Listado --}}
            <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] p-6">

                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Listado de transacciones
                        </h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Administra los movimientos de tus cuentas.
                        </p>
                    </div>

                    <a href="{{ route('transacciones.create') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-[#E98BB5] text-white text-sm font-medium rounded-lg hover:bg-[#D978A5] transition">
                        + Nueva transacción
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#F8DCE9]">
                        <thead class="bg-[#FFF4F8]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Cuenta
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Categoría
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Monto
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#FCEAF1]">
                            @forelse ($transacciones as $transaccion)
                                <tr class="hover:bg-[#FFF9FB] transition">
                                    <td class="px-4 py-4">
                                        <span class="font-semibold text-gray-800">
                                            {{ $transaccion->cuenta->nombre ?? 'Sin cuenta' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $transaccion->categoria->nombre ?? 'Sin categoría' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if ($transaccion->tipo === 'ingreso')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-[#D8F5E8] text-[#23996C]">
                                                Ingreso
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-[#FFE0D8] text-[#D96D59]">
                                                Gasto
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="font-semibold {{ $transaccion->tipo === 'ingreso' ? 'text-[#23996C]' : 'text-[#D96D59]' }}">
                                            {{ $transaccion->cuenta->moneda ?? 'COP' }}
                                            {{ number_format($transaccion->monto, 2, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($transaccion->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $transaccion->descripcion ?? 'Sin descripción' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <a href="{{ route('transacciones.edit', $transaccion) }}"
                                               class="text-sm font-medium text-[#8652C7] hover:text-[#7041AC] hover:underline">
                                                Editar
                                            </a>

                                            <form action="{{ route('transacciones.destroy', $transaccion) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Deseas eliminar esta transacción?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-sm font-medium text-[#D96D59] hover:text-red-700 hover:underline">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-10 text-center">
                                        <p class="text-gray-500 font-medium">
                                            Todavía no tienes transacciones registradas.
                                        </p>
                                        <p class="text-sm text-gray-400 mt-1">
                                            Registra tu primer ingreso o gasto para comenzar a controlar tus movimientos.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
