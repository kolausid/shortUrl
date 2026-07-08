<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои ссылки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Форма --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <form action="{{ route('links.store') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div class="flex-1">
                        <input name="original_url"
                               placeholder="Вставьте ссылку"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 whitespace-nowrap">
                        Сократить
                    </button>
                </form>

                @if(session('success'))
                    <div class="mt-3 text-green-600 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('deleted'))
                    <div class="mt-3 text-red-600 font-medium">
                        {{ session('deleted') }}
                    </div>
                @endif
            </div>

            {{-- Таблица --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Оригинальный URL</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Короткая ссылка</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Клики</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($urls as $url)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 truncate max-w-xs">{{ $url->original_url }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ url($url->short_url) }}" target="_blank" class="text-indigo-600 hover:underline">
                                            {{ url($url->short_url) }}
                                        </a>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $url->clicks_count }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('link.stat', $url->id) }}" class="text-indigo-600 hover:underline">Подробнее</a>
                                            <form action="{{ route('link.delete', $url->id) }}" method="POST" onsubmit="return confirm('Удалить ссылку?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-6 text-center text-gray-500">
                                        У вас пока нет сокращённых ссылок
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