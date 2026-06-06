<nav x-data="{ open: false }" style="background: linear-gradient(135deg, #2C1810 0%, #4A2C17 100%); border-bottom: 2px solid #C8956C;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span style="color: #C8956C; font-size: 1.5rem;">✦</span>
                        <span style="color: #F5E6D3; font-family: Georgia, serif; font-size: 1.2rem; font-weight: bold; letter-spacing: 2px;">MON BLOG</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('home') }}" style="color: #C8956C; font-size: 0.9rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 600;">
                        Accueil
                    </a>
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @auth
                @if(auth()->user())
                <a href="{{ route('posts.create') }}"
                   style="background: #C8956C; color: #2C1810; padding: 8px 20px; border-radius: 25px; font-weight: bold; font-size: 0.85rem; letter-spacing: 1px;">
                    + Nouveau Post
                </a>
                @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button style="color: #F5E6D3; background: rgba(200,149,108,0.2); border: 1px solid #C8956C; padding: 6px 16px; border-radius: 20px; font-size: 0.9rem;">
                            {{ Auth::user()?->name }} ▾
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}"
                   style="color: #F5E6D3; border: 1px solid #C8956C; padding: 6px 16px; border-radius: 20px; font-size: 0.9rem;">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   style="background: #C8956C; color: #2C1810; padding: 8px 20px; border-radius: 25px; font-weight: bold; font-size: 0.85rem;">
                    S'inscrire
                </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" style="color: #C8956C;" class="inline-flex items-center justify-center p-2 rounded-md">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: #2C1810; border-top: 1px solid #C8956C;">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" style="color: #C8956C; display: block; padding: 8px 0;">Accueil</a>
        </div>
        @auth
        <div class="pt-4 pb-1 border-t" style="border-color: #C8956C;">
            <div class="px-4 mb-2">
                <div style="color: #F5E6D3; font-weight: bold;">{{ Auth::user()?->name }}</div>
                <div style="color: #C8956C; font-size: 0.85rem;">{{ Auth::user()?->email }}</div>
            </div>
            <div class="mt-3 space-y-1 px-4 pb-3">
                <a href="{{ route('profile.edit') }}" style="color: #F5E6D3; display: block; padding: 6px 0;">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                       style="color: #C8956C; display: block; padding: 6px 0;">Log Out</a>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>