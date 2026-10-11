<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Strategic Risk Dashboard
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                e-RMS Strategic Module | Universiti Teknologi MARA
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Section -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900">
                    Welcome, {{ auth()->user()->name }}!
                </h3>
                <p class="text-gray-500 mt-1">
                    Strategic Risk Management Overview
                    <span class="mx-2">|</span>
                    {{ strtoupper(auth()->user()->role) }}
                </p>
            </div>

            <!-- Development Notice -->
            <!--<div class="bg-purple-50 border border-purple-200
                        rounded-xl p-4 mb-8">
                <p class="text-sm text-purple-900">
                    <span class="font-semibold">
                        Development Preview:
                    </span>
                    This dashboard displays sample data
                    from the development database.
                </p>
            </div>-->

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-4 gap-6 mb-8">

                <!-- Total Risks -->
                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div class="bg-purple-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-purple-700"
                                 fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12h6m-6 4h6M5 4h14v16H5z"/>
                            </svg>
                        </div>
                    </div>

                    <p class="text-sm font-medium text-gray-500 mt-5">
                        Total Strategic Risks
                    </p>
                    <h3 class="text-4xl font-bold text-gray-900 mt-2">
                        {{ $stats['totalRisks'] }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">
                        Registered risk records
                    </p>
                </div>

                <!-- High Impact Risks -->
                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-200 p-6">
                    <div class="bg-red-100 rounded-xl p-3 w-fit">
                        <svg class="w-7 h-7 text-red-600"
                             fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v4m0 4h.01M10 3L2 19h20L14 3h-4z"/>
                        </svg>
                    </div>

                    <p class="text-sm font-medium text-gray-500 mt-5">
                        High-Impact Risks
                    </p>
                    <h3 class="text-4xl font-bold text-red-600 mt-2">
                        {{ $stats['highImpactRisks'] }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">
                        Flagged high-impact records
                    </p>
                </div>

                <!-- Total KRIs -->
                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-200 p-6">
                    <div class="bg-blue-100 rounded-xl p-3 w-fit">
                        <svg class="w-7 h-7 text-blue-700"
                             fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 19V5m0 14h16M8 15l4-5 4 3 4-7"/>
                        </svg>
                    </div>

                    <p class="text-sm font-medium text-gray-500 mt-5">
                        Total KRIs
                    </p>
                    <h3 class="text-4xl font-bold text-blue-700 mt-2">
                        {{ $stats['totalKris'] }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">
                        Key Risk Indicators
                    </p>
                </div>

                <!-- Total Sub-KRIs -->
                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-200 p-6">
                    <div class="bg-green-100 rounded-xl p-3 w-fit">
                        <svg class="w-7 h-7 text-green-700"
                             fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>

                    <p class="text-sm font-medium text-gray-500 mt-5">
                        Total Sub-KRIs
                    </p>
                    <h3 class="text-4xl font-bold text-green-700 mt-2">
                        {{ $stats['totalSubKris'] }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">
                        Sub-Risk Indicators
                    </p>
                </div>
            </div>

            <!-- Organisational Overview Card -->
            <div class="bg-white rounded-2xl shadow-sm
                        border border-gray-200 p-6 mb-8">

                <h3 class="text-lg font-bold text-gray-900 mb-5">
                    Organisational Overview
                </h3>

                <div class="bg-purple-50 rounded-xl p-5
                            flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">
                            Total Responsibility Centres
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Pusat Tanggungjawab (PTJ)
                        </p>
                    </div>

                    <span class="text-3xl font-bold text-purple-800">
                        {{ $stats['totalPtjs'] }}
                    </span>
                </div>
            </div>

            <!-- Recent Risk Records Card -->
            <div class="bg-white rounded-2xl shadow-sm
                        border border-gray-200 overflow-hidden">

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        Recent Strategic Risk Records
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Latest five records from the development database
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-purple-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Risk Number
                                </th>
                                <th class="px-6 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    PTJ
                                </th>
                                <th class="px-6 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Year
                                </th>
                                <th class="px-6 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Risk Level
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($recentRisks as $risk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        {{ $risk->risk_number ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        {{ $risk->ptj?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        {{ $risk->year }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1
                                                     rounded-full text-xs
                                                     font-semibold bg-purple-100
                                                     text-purple-800">
                                            {{ $risk->risk_level ?? 'Not specified' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-8 text-center text-gray-500">
                                        No risk records available.
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
