<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Notifications récentes</h3>

        @forelse($notifications as $note)
            <div class="{{ $note->is_read ? 'bg-gray-100 dark:bg-gray-700' : 'bg-blue-100 dark:bg-blue-900' }} text-blue-800 dark:text-blue-100 p-4 mb-3 rounded-lg shadow-sm">
                <div class="flex items-start justify-between">
                    <p class="text-sm">{{ $note->message }}</p>
                    <span class="text-xs text-gray-500 dark:text-gray-300 whitespace-nowrap">
                        {{ $note->created_at ? $note->created_at->diffForHumans() : 'Date inconnue' }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">Aucune notification pour le moment.</p>
        @endforelse
    </div>
</x-app-layout>