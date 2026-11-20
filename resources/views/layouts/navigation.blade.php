<nav x-data="{ open: false }" class="bg-[#FFF4F8] border-b border-[#F8DCE9] shadow-sm">

    {{-- Menú principal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center">

                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-10 w-auto fill-current text-[#A77BDD]" />
                        <span class="hidden lg:block text-lg font-bold text-[#8652C7]">
                            Gestor Financiero
                        </span>
                    </a>
                </div>

                {{-- Enlaces de navegación --}}
                <div class="hidden sm:flex items-center space-x-2 sm:ms-8">

                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                        {{ request()->routeIs('dashboard')
                            ? 'bg-[#E9D8FF] text-[#7041AC]'
                            : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('categorias.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                        {{ request()->routeIs('categorias.*')
                            ? 'bg-[#E9D8FF] text-[#7041AC]'
                            : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                        Categorías
                    </a>

                    <a href="{{ route('cuentas.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                        {{ request()->routeIs('cuentas.*')
                            ? 'bg-[#E9D8FF] text-[#7041AC]'
                            : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                        Cuentas
                    </a>

                    <a href="{{ route('transacciones.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                        {{ request()->routeIs('transacciones.*')
                            ? 'bg-[#E9D8FF] text-[#7041AC]'
                            : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                        Transacciones
                    </a>

                </div>
            </div>

            {{-- Menú del usuario --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7] focus:outline-none transition duration-200">

                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <a href="{{ route('profile.edit') }}"
                            class="block w-full px-4 py-2 text-sm text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7] transition">
                            Mi perfil
                        </a>

                        <div class="border-t border-[#F8DCE9]"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-[#D96D59] hover:bg-[#FFE0D8] transition">
                                Cerrar sesión
                            </button>
                        </form>

                    </x-slot>
                </x-dropdown>

            </div>

            {{-- Botón menú móvil --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-[#8652C7] hover:bg-[#E9D8FF] focus:outline-none transition duration-200">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

        </div>
    </div>

    {{-- Menú adaptable a dispositivos móviles --}}
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden border-t border-[#F8DCE9] bg-[#FFF4F8]">

        <div class="pt-3 pb-3 px-4 space-y-2">

            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-[#E9D8FF] text-[#7041AC]'
                    : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                Dashboard
            </a>

            <a href="{{ route('categorias.index') }}"
                class="block px-4 py-2 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('categorias.*')
                    ? 'bg-[#E9D8FF] text-[#7041AC]'
                    : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                Categorías
            </a>

            <a href="{{ route('cuentas.index') }}"
                class="block px-4 py-2 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('cuentas.*')
                    ? 'bg-[#E9D8FF] text-[#7041AC]'
                    : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                Cuentas
            </a>

            <a href="{{ route('transacciones.index') }}"
                class="block px-4 py-2 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('transacciones.*')
                    ? 'bg-[#E9D8FF] text-[#7041AC]'
                    : 'text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7]' }}">
                Transacciones
            </a>

        </div>

        {{-- Información del usuario --}}
        <div class="pt-4 pb-3 border-t border-[#F8DCE9]">

            <div class="px-4">
                <div class="font-semibold text-sm text-[#8652C7]">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-xs text-[#8B8495] mt-1">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 px-4 space-y-2">

                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 rounded-xl text-sm text-[#686575] hover:bg-[#FCEAF1] hover:text-[#8652C7] transition">
                    Mi perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="block w-full text-left px-4 py-2 rounded-xl text-sm text-[#D96D59] hover:bg-[#FFE0D8] transition">
                        Cerrar sesión
                    </button>
                </form>

            </div>
        </div>

    </div>

</nav>
