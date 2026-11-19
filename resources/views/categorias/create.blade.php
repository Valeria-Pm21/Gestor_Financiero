
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Nueva categoría
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Organiza tus ingresos y gastos.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#FFF4F8] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <h3 class="text-2xl font-bold text-[#8652C7]">
                    Crear categoría financiera
                </h3>
                <p class="text-gray-500 mt-1">
                    Registra una categoría para clasificar tus movimientos.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-[#F8DCE9] overflow-hidden">

                <div class="bg-[#F9EDFF] border-b border-[#E9D8FF] px-6 py-4">
                    <h3 class="text-lg font-semibold text-[#7041AC]">
                        Información de la categoría
                    </h3>
                    <p class="text-sm text-[#9876BC] mt-1">
                        Completa los datos solicitados.
                    </p>
                </div>

                <div class="p-6">

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

                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nombre de la categoría
                                </label>

                                <input type="text" name="nombre"
                                       value="{{ old('nombre') }}"
                                       placeholder="Ej. Alimentación"
                                       class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD] placeholder-gray-400"
                                       required>

                                @error('nombre')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tipo de categoría
                                </label>

                                <select name="tipo"
                                        class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD]"
                                        required>
                                    <option value="">Seleccione un tipo</option>

                                    <option value="ingreso" {{ old('tipo') == 'ingreso' ? 'selected' : '' }}>
                                        Ingreso
                                    </option>

                                    <option value="gasto" {{ old('tipo') == 'gasto' ? 'selected' : '' }}>
                                        Gasto
                                    </option>
                                </select>

                                @error('tipo')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror

                                <p class="text-xs text-gray-400 mt-2">
                                    Ingreso: dinero recibido. Gasto: dinero utilizado.
                                </p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Descripción
                                </label>

                                <textarea name="descripcion" rows="3"
                                          placeholder="Escribe una descripción de la categoría..."
                                          class="w-full rounded-lg border-[#F2C9DC] focus:border-[#A77BDD] focus:ring-[#A77BDD] placeholder-gray-400">{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <p class="text-sm text-[#D96D59] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-[#FCEAF1]">

                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#E98BB5] text-white font-semibold rounded-lg hover:bg-[#D978A5] transition shadow-sm">
                                Guardar categoría
                            </button>

                            <a href="{{ route('categorias.index') }}"
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
