<x-app-layout >
    <div class="flex min-h-screen">
        <div class="bg-blue-950 px-4 py-2 lg:w-1/4">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 w-8 text-white lg:hidden" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <div class="hidden lg:block">
                <div class="my-2 mb-6">
                    <!-- <h1 class="text-2xl font-bold text-white">Dashboard</h1> -->
                    <img src="{{ asset(Auth::user()->societe->logo ?? 'logo-sofimed.png') }}" alt="Logo" class="h-12 w-auto mt-10">
                </div>
                <ul>
                    <li @class([
                        'mb-2 rounded hover:bg-gray-800 hover:shadow',
                        'bg-gray-800 shadow' => request()->routeIs('dashboard'),
                    ])>
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-mt-1 mr-2 inline-block h-6 w-6"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Accueil
                        </a>
                    </li>
                    <li @class([
                        'mb-2 rounded hover:bg-gray-800 hover:shadow',
                        'bg-gray-800 shadow' => request()->routeIs('tickets.*'),
                    ])>
                        <a href="{{ route('tickets.index') }}" wire:navigate
                            class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                            </svg>
                            Tickets
                        </a>
                    </li>
                    @can('manage users')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('users.*'),
                        ])>
                            <a href="{{ route('users.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                Utilisateur
                            </a>
                        </li>
                    @endcan
                    @can('access logs')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('logs.*'),
                        ])>
                            <a href="{{ route('logs.index') }}"
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-mt-1 mr-2 inline-block h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Ticket Logs
                            </a>
                        </li>
                    @endcan
                    @can('manage categories')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('categories.*'),
                        ])>
                            <a href="{{ route('categories.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                </svg>
                                Catégories
                            </a>
                        </li>
                    @endcan
                    @can('manage stock')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('stock.*'),
                        ])>
                            <a href="{{ route('stock.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg class="-mt-1 mr-2 inline-block h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z"/>
                                </svg>

                                Stock PC
                            </a>
                        </li>
                    @endcan
                    @can('manage stock')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('phone.*'),
                        ])>
                            <a href="{{ route('phone.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                
                                <svg class="-mt-1 mr-2 inline-block h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5 4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4Zm12 12V5H7v11h10Zm-5 1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                                </svg>


                                Stock Téléphones
                            </a>
                        </li>
                    @endcan
                    @can('manage stock')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('archive.*'),
                        ])>
                            <a href="{{ route('archive.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg class="-mt-1 mr-2 inline-block h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z"/>
                                </svg>


                                Archive Stock
                            </a>
                        </li>
                    @endcan
                    @can('manage stock')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('category_stock.*'),
                        ])>
                            <a href="{{ route('category_stock.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                </svg>
                                Catégories Stock
                            </a>
                        </li>
                    @endcan
                    @can('manage stock')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('departement.*'),
                        ])>
                            <a href="{{ route('departement.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg class="-mt-1 mr-2 inline-block h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                                </svg>
                                Départements
                            </a>
                        </li>
                    @endcan
                    @can('manage societe')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('societe.*'),
                        ])>
                            <a href="{{ route('societe.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg class="-mt-1 mr-2 inline-block h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z"/>
                                </svg>
                                Sociétés
                            </a>
                        </li>
                    @endcan
                    @can('manage labels')
                        <li @class([
                            'mb-2 rounded hover:bg-gray-800 hover:shadow',
                            'bg-gray-800 shadow' => request()->routeIs('labels.*'),
                        ])>
                            <a href="{{ route('labels.index') }}" wire:navigate
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                                Labels
                            </a>
                        </li>
                    @endcan
                    <hr class="my-4">
                    <li class="mb-2 mt-4 rounded hover:bg-gray-800 hover:shadow">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                class="inline-block h-full w-full px-3 py-2 font-bold text-white"
                                onclick="event.preventDefault();this.closest('form').submit();" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="-mt-1 mr-2 inline-block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                Déconnexion
                            </a>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
        <div class="w-full bg-gray-200 px-4 py-2 lg:w-full">
            <div class="container mt-12 px-10">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
