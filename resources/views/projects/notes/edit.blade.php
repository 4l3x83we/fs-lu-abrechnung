<x-app-layout>
    <div class="p-4">
        <div class="block sm:flex items-center justify-between">
            <div class="w-full mb-1">
                <div class="items-center justify-between block sm:flex">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Note edit') }}</h1>
                    </div>
                    <x-custom.button.link-a href="{{ route('project.notes.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 duration-300">
                        <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                        </svg>
                        {{ __('Back') }}
                    </x-custom.button.link-a>
                </div>
            </div>
        </div>
    </div>
    <x-custom.main.head>
        <div class="mx-auto container p-4">
            <x-custom.card.head>
                @livewire('projects.notes.notes-edit', ['notes' => $note])
            </x-custom.card.head>
        </div>
    </x-custom.main.head>
</x-app-layout>
