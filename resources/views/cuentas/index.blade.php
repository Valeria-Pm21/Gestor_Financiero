<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Mis cuentas
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Consulta y administra el dinero de tus cuentas.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Título de la sección --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    Tus cuentas financieras
                </h3>
                <p class="text-gray-500 mt-1">
                    Aquí puedes revisar tus cuentas y sus saldos disponibles.
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
                            Listado de cuentas
                        </h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Administra tus cuentas registradas.
                        </p>
                    </div>

                    <a href="{{ route('cuentas.create') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-[#E98BB5] text-white text-sm font-medium rounded-lg hover:bg-[#D978A5] transition">
                        + Nueva cuenta
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#F8DCE9]">
                        <thead class="bg-[#FFF4F8]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Saldo
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Moneda
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#FCEAF1]">
                            @forelse ($cuentas as $cuenta)
                                <tr class="hover:bg-[#FFF9FB] transition">
                                    <td class="px-4 py-4">
                                        <span class="font-semibold text-gray-800">
                                            {{ $cuenta->nombre }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $cuenta->descripcion ?? 'Sin descripción' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="font-semibold text-[#8652C7]">
                                            {{ $cuenta->moneda }} {{ number_format($cuenta->saldo, 2, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-[#E9D8FF] text-[#7041AC]">
                                            {{ $cuenta->moneda }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <a href="{{ route('cuentas.edit', $cuenta) }}"
                                               class="text-sm font-medium text-[#8652C7] hover:text-[#7041AC] hover:underline">
                                                Editar
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('cuentas.destroy', $cuenta) }}"
                                                  onsubmit="return confirm('¿Eliminar esta cuenta?')">
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
                                    <td colspan="5" class="px-4 py-10 text-center">
                                        <p class="text-gray-500 font-medium">
                                            Todavía no tienes cuentas registradas.
                                        </p>
                                        <p class="text-sm text-gray-400 mt-1">
                                            Crea tu primera cuenta para comenzar a organizar tus finanzas.
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