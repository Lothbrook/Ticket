<div class="min-h-screen bg-gray-100 py-8 px-6">
    <div class="mb-8 text-3xl font-bold text-gray-700">Dashboard</div>

    <!-- Section Tickets -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Tickets Ouverts -->
        <div class="rounded-lg bg-white p-6 shadow-lg hover:shadow-xl transition-shadow">
            <a href="{{ route('tickets.index') }}" class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-8 w-8 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-600">Tickets Ouverts</h3>
                    <p class="mt-2 text-3xl font-semibold text-red-600">
                        {{ $openTickets }} <span class="text-gray-400">/ {{ $totalTickets }}</span>
                    </p>
                </div>
            </a>
        </div>

        <!-- Tickets Fermés -->
        <div class="rounded-lg bg-white p-6 shadow-lg hover:shadow-xl transition-shadow">
            <a href="{{ route('tickets.index') }}" class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-8 w-8 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-600">Tickets Fermés</h3>
                    <p class="mt-2 text-3xl font-semibold text-green-600">
                        {{ $closedTickets }} <span class="text-gray-400">/ {{ $totalTickets }}</span>
                    </p>
                </div>
            </a>
        </div>
    </div>

    @can('manage stock')
    <!-- Section Stocks -->
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Ordinateurs -->
        <div class="rounded-lg bg-white p-6 shadow-lg hover:shadow-xl transition-shadow">
            <a href="{{ route('stock.index') }}" class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-600">Nombre des Ordinateurs</h3>
                    <p class="mt-2 text-3xl font-semibold text-blue-600">
                        {{ $pc }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Téléphones -->
        <div class="rounded-lg bg-white p-6 shadow-lg hover:shadow-xl transition-shadow">
            <a href="{{ route('phone.index') }}" class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-purple-100">
                    <svg class="h-8 w-8 text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4Zm12 12V5H7v11h10Zm-5 1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-600">Nombre de Téléphones</h3>
                    <p class="mt-2 text-3xl font-semibold text-purple-600">
                        {{ $phones }}
                    </p>
                </div>
            </a>
        </div>
    </div>
    @endcan
</div>
