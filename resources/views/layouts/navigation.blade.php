<nav x-data="{ open: false }" class="bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('spotify.png') }}" alt="Spotify Logo" class="h-10 w-auto" />
                </a>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('playlists.create')" :active="request()->routeIs('playlists.create')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                        {{ __('Choose Mood') }}
                    </x-nav-link>
                    <x-nav-link :href="route('playlists.history')" :active="request()->routeIs('playlists.history')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                        {{ __('Playlist History') }}
                    </x-nav-link>
                </div>

                <!-- Settings Dropdown (Desktop) -->
                <div class="hidden sm:flex items-center space-x-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-200 hover:text-white focus:outline-none transition duration-300 ease-in-out">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>

    <!-- Hamburger (Mobile) -->
    <div class="sm:hidden flex items-center px-4 py-3">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900">
        <div class="space-y-1 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('playlists.create')" :active="request()->routeIs('playlists.create')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                {{ __('Choose Mood') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('playlists.history')" :active="request()->routeIs('playlists.history')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                {{ __('Playlist History') }}
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Settings Options -->
        <div class="border-t border-gray-700 py-3">
            <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-indigo-300 focus:outline-none focus:text-white transition duration-300 ease-in-out">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
