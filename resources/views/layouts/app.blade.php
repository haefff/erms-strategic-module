<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>e-RMS Strategic Module | UiTM</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">

<div x-data="{ sidebarOpen: false }" class="min-h-screen">

    <!-- Mobile Sidebar Overlay -->
    <div
        x-show="sidebarOpen"
        x-cloak
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden">
    </div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64
               bg-[#351455] text-white
               transform transition-transform duration-200
               lg:translate-x-0 flex flex-col"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        <!-- Branding -->
        <div class="flex items-center gap-3 px-5 py-6 border-b border-white/20">

            <img
                src="{{ asset('images/uitm-logo.png') }}"
                alt="UiTM Logo"
                class="w-12 h-12 object-contain bg-white rounded-lg p-1"
            >

            <div>
                <h1 class="text-lg font-bold leading-tight">
                    e-RMS
                </h1>

                <p class="text-xs text-purple-200">
                    Strategic Module
                </p>

                <p class="text-xs text-purple-200">
                    Universiti Teknologi MARA
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-6 space-y-2">

            <p class="px-3 mb-3 text-xs font-semibold
                      uppercase tracking-wider text-purple-300">
                Main Menu
            </p>

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
               transition
               {{ request()->routeIs('dashboard')
                   ? 'bg-white text-purple-900 font-semibold'
                   : 'text-purple-100 hover:bg-white/10' }}">

                <svg class="w-5 h-5" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"
                          d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z"/>
                </svg>

                <span>Dashboard</span>
            </a>

            <!-- Risk Register Placeholder -->

            <!-- Risk Register -->
            <a href="{{ route('risks.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl
                    transition
                    {{ request()->routeIs('risks.*')
                        ? 'bg-white text-purple-900 font-semibold'
                        : 'text-purple-100 hover:bg-white/10' }}">

                <svg class="w-5 h-5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                </svg>

                <span>Risk Register</span>
            </a>


            <!-- High Impact Placeholder -->
            <div class="flex items-center justify-between
                        px-4 py-3 rounded-xl text-purple-200/70">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M12 9v4m0 4h.01M10 3L2 19h20L14 3h-4z"/>
                    </svg>

                    <span>High-Impact Risks</span>
                </div>


            </div>

            <!-- KRI Placeholder -->
            <div class="flex items-center justify-between
                        px-4 py-3 rounded-xl text-purple-200/70">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M4 19V5m0 14h16M8 15l4-5 4 3 4-7"/>
                    </svg>

                    <span>KRI &amp; Sub-KRI</span>
                </div>


            </div>

            <!-- Admin-Specific Menu -->
            @if(auth()->user()->isAdmin())

                <p class="px-3 pt-6 pb-2 text-xs font-semibold
                          uppercase tracking-wider text-purple-300">
                    Administration
                </p>

                <div class="flex items-center justify-between
                            px-4 py-3 rounded-xl text-purple-200/70">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2"
                                  d="M4 4h16v16H4zM12 8v8m-4-4h8"/>
                        </svg>

                        <span>Data Import</span>
                    </div>


                </div>
            @endif

            <!-- LPU-Specific Menu -->
            @if(auth()->user()->isLpu())

                <p class="px-3 pt-6 pb-2 text-xs font-semibold
                          uppercase tracking-wider text-purple-300">
                    LPU Management
                </p>

                <div class="flex items-center justify-between
                            px-4 py-3 rounded-xl text-purple-200/70">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4M12 2l9 4v6c0 5-4 9-9 10C7 21 3 17 3 12V6z"/>
                        </svg>

                        <span>KRI Approvals</span>
                    </div>


                </div>
            @endif

            <!-- Reports Placeholder -->
            <div class="flex items-center justify-between
                        px-4 py-3 rounded-xl text-purple-200/70">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M9 17v-6m4 6V7m4 10v-4M5 3h14v18H5z"/>
                    </svg>

                    <span>Reports</span>
                </div>


            </div>

            <p class="px-3 pt-6 pb-2 text-xs font-semibold
                      uppercase tracking-wider text-purple-300">
                Account
            </p>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
               transition
               {{ request()->routeIs('profile.*')
                   ? 'bg-white text-purple-900 font-semibold'
                   : 'text-purple-100 hover:bg-white/10' }}">

                <svg class="w-5 h-5" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"
                          d="M12 12a4 4 0 100-8 4 4 0 000 8zM4 21a8 8 0 0116 0"/>
                </svg>

                <span>My Profile</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/20">

            <div class="mb-4">
                <p class="text-sm font-semibold">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-purple-200">
                    {{ strtoupper(auth()->user()->role) }}
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full px-4 py-2.5 rounded-lg
                               bg-white/10 hover:bg-white/20
                               text-sm font-medium transition">
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:pl-64 min-h-screen">

        <!-- Top Navigation -->
        <header class="sticky top-0 z-30
                       bg-white border-b border-gray-200">

            <div class="flex items-center justify-between
                        h-16 px-4 sm:px-8">

                <div class="flex items-center gap-4">

                    <!-- Mobile Menu Button -->
                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        aria-label="Open navigation"
                        class="lg:hidden p-2 text-gray-700">

                        <svg class="w-6 h-6" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <span class="font-semibold text-gray-800">
                        e-RMS Strategic Module
                    </span>
                </div>

                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ strtoupper(auth()->user()->role) }}
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full
                                bg-purple-100 text-purple-800
                                flex items-center justify-center
                                font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Header -->
        @isset($header)
            <div class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>
