<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Risk Register
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Strategic Risk Records | e-RMS Strategic Module
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Heading -->
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    Strategic Risk Management
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    View and search registered strategic risks.
                </p>
            </div>

            <!-- Development Notice
            <div class="bg-purple-50 border border-purple-200
                        rounded-xl px-5 py-4 mb-6">
                <p class="text-sm text-purple-900">
                    Development Preview:
                    This page currently displays dummy risk data.
                </p>
            </div>-->

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-sm
                        border border-gray-200 overflow-hidden">

                <!-- Card Header -->
                <div class="p-6 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row
                                md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Risk Records
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $risks->total() }} matching records
                            </p>
                        </div>

                        <!-- Search -->
                        <form method="GET"
                              action="{{ route('risks.index') }}"
                              class="flex flex-wrap gap-2">

                            <input
                                type="search"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search risks or PTJ..."
                                aria-label="Search risk records"
                                class="rounded-lg border-gray-300
                                       text-sm focus:border-purple-500
                                       focus:ring-purple-500 w-64 max-w-full"
                            >

                            <button type="submit"
                                    class="bg-purple-800 hover:bg-purple-900
                                           text-white px-5 py-2 rounded-lg
                                           text-sm font-medium">
                                Search
                            </button>

                            @if($search !== '')
                                <a href="{{ route('risks.index') }}"
                                   class="px-4 py-2 border border-gray-300
                                          rounded-lg text-sm text-gray-600
                                          hover:bg-gray-50">
                                    Reset
                                </a>
                            @endif
                        </form>

                    </div>
                </div>

                <!-- Risk Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-purple-50">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    ID
                                </th>

                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Risk Description
                                </th>

                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    PTJ
                                </th>

                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Year
                                </th>

                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    Risk Level
                                </th>

                                <th class="px-5 py-4 text-left text-xs
                                           font-bold uppercase text-purple-900">
                                    High-Impact
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">

                            @forelse($risks as $risk)
                                <tr class="hover:bg-purple-50/40">

                                    <td class="px-5 py-4 text-sm
                                               font-medium text-gray-700">
                                        {{ $risk->id }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-800
                                               min-w-[250px]">
                                        {{ \Illuminate\Support\Str::limit($risk->risk_description, 95) }}

                                        @if($risk->risk_number)
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $risk->risk_number }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $risk->ptj?->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $risk->year }}
                                    </td>

                                    <td class="px-5 py-4">
                                        @php
                                            $level = strtoupper(
                                                trim($risk->risk_level ?? '')
                                            );

                                            $levelClass = match($level) {
                                                'TINGGI', 'HIGH', 'EXTREME',
                                                'SANGAT TINGGI' =>
                                                    'bg-red-100 text-red-700',

                                                'SEDERHANA', 'MEDIUM' =>
                                                    'bg-yellow-100 text-yellow-800',

                                                'RENDAH', 'LOW' =>
                                                    'bg-green-100 text-green-700',

                                                default =>
                                                    'bg-gray-100 text-gray-600',
                                            };
                                        @endphp

                                        <span class="inline-flex rounded-full
                                                     px-3 py-1 text-xs
                                                     font-semibold whitespace-nowrap
                                                     {{ $levelClass }}">
                                            {{ $risk->risk_level ?? 'Not specified' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        @if($risk->is_high_impact)
                                            <span class="inline-flex rounded-full
                                                         bg-red-100 text-red-700
                                                         px-3 py-1 text-xs
                                                         font-semibold">
                                                Yes
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full
                                                         bg-gray-100 text-gray-600
                                                         px-3 py-1 text-xs
                                                         font-semibold">
                                                No
                                            </span>
                                        @endif
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-12 text-center
                                               text-gray-500">
                                        No risk records found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5 border-t border-gray-100">
                    {{ $risks->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
