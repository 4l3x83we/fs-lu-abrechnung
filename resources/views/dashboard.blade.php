<x-app-layout>
    <x-custom.main.head>
        <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4">
            <div class="col-span-full xl:col-auto">
                <x-custom.card.head>
                    <div class="items-start sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                        @if(auth()->user()->teamImage())
                            <img class="mb-4 rounded w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 object-scale-down object-center {{ auth()->user()->teamImage() ?? 'bg-gray-100' }}" src="{{ auth()->user()->teamImage() }}" alt="{{ auth()->user()->teamName() ?? 'Teambild' }}">
                        @else
                            <div class="mb-4 rounded w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 dark:text-gray-200 dark:hover:bg-gray-700 bg-gray-200 dark:bg-gray-700 leading-none">
                                <div class="flex justify-center items-center w-28 h-28 font-bold text-6xl">
                                    {{ initialsAll(auth()->user()->teamName()) }}
                                </div>
                            </div>
                        @endif
                        <div>
                            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->teamName() }}</h3>
                            <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Project') }}: {{ auth()->user()->projectName() }}
                            </div>
                            @can('manage_users')
                            <div class="flex items-center space-x-4 mb-2">
                                <a href="{{ route('settings.admin.maps.index') }}" class="text-sm">
                                    <span class="mr-1">{{ __('Map') }}:</span>{{ auth()->user()->mapAuswahl()['maps'] }}
                                </a>
                            </div>
                            <div class="flex items-center space-x-4 mb-2">
                                <div>
                                    <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Team Logo') }}:</div>
                                    <livewire:admin.team-pictures/>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div>
                                    <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Project Logo') }}:</div>
                                    <livewire:admin.project-pictures/>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
        </div>
    </x-custom.main.head>
</x-app-layout>
