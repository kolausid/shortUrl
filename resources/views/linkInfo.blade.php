<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Статистика переходов') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Инфо о ссылке --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <p class="mb-2">
                    <span class="font-semibold">Короткая ссылка:</span>
                    <a href="{{ url($link->short_url) }}" target="_blank" class="text-indigo-600 hover:underline ml-2">
                        {{ url($link->short_url) }}
                    </a>
                </p>
                <p class="mb-4">
                    <span class="font-semibold">Всего кликов:</span>
                    <span class="ml-2">{{ $link->clicks_count }}</span>
                </p>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Назад к списку</a>
            </div>

            {{-- Таблица переходов --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">IP-адрес</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Браузер</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats as $stat)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $stat->ip_address }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $stat->user_agent }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $stat->created_at->format('d.m.Y H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="border border-gray-300 px-4 py-6 text-center text-gray-500">
                                        Переходов пока не было
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