<x-app-layout>
    <div class="p-4">
        @include('settings.layouts.menu')
        <div class="block sm:flex items-center justify-between">
            <div class="w-full mb-1">
                <div class="mb-4">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Map selection') }}</h1>
                </div>
                <div class="items-center justify-between block sm:flex">
                    <div class="flex items-center mb-4 sm:mb-0">
{{--                        <livewire:maps.search />--}}
                    </div>
                    <x-custom.button.link-a href="{{ route('settings.admin.maps.create') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 duration-300">
                        <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                        {{ __('Add new map configuration') }}
                    </x-custom.button.link-a>
                </div>
            </div>
        </div>
    </div>
    <x-custom.main.head>
        <x-custom.table.responsive.table>
            <x-custom.table.responsive.thead>
                <tr>
                    <x-custom.table.responsive.th class="!py-2 !px-4" text="ID"/>
                    <x-custom.table.responsive.th text="Author"/>
                    <x-custom.table.responsive.th text="Version"/>
                    <x-custom.table.responsive.th text="Map"/>
                    <x-custom.table.responsive.th text="Beschreibung"/>
                    <x-custom.table.responsive.th text="Felder"/>
                    <x-custom.table.responsive.th class="!py-2 !px-4"/>
                </tr>
            </x-custom.table.responsive.thead>
            <x-custom.table.responsive.tbody>
                @foreach($maps as $map)
                    <x-custom.table.responsive.tr>
                        <x-custom.table.responsive.td class="!py-2 !px-4 {{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}" :text="$map['id']"/>
                        <x-custom.table.responsive.td class="{{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}" :text="$map['md_author']"/>
                        <x-custom.table.responsive.td class="{{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}">
                            <x-custom.badge.badge color="purple">{{ $map['md_version'] }}</x-custom.badge.badge>
                        </x-custom.table.responsive.td>
                        <x-custom.table.responsive.td class="{{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}" :text="$map['md_title'][$lang] . ' / ('.$map['md_title']['en'].')'"/>
                        <x-custom.table.responsive.td class="{{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}" :text="$map['md_desc'][$lang]"/>
                        <x-custom.table.responsive.td class="{{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}">
                            <x-custom.badge.badge>{{ $map['md_fields'] }}</x-custom.badge.badge>
                        </x-custom.table.responsive.td>
                        <x-custom.table.responsive.td class="!py-2 !px-4 {{ auth()->user()->projectMapID() == $map['id'] ? 'font-bold text-green-800 dark:text-green-600' : 'font-medium text-gray-900 dark:text-white' }}">
                            <div class="flex justify-end text-right mr-2">
                                @if(auth()->user()->projectMapID() == $map['id'])
                                    <x-custom.badge.icon-badge>
                                        <svg class="w-2.5 h-2.5 text-green-800 dark:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                        </svg>
                                    </x-custom.badge.icon-badge>
                                @else
                                    @livewire('button.map-change-button', ['mapID' => $map['id']])
                                @endif
                            </div>
                        </x-custom.table.responsive.td>
                    </x-custom.table.responsive.tr>
                @endforeach
            </x-custom.table.responsive.tbody>
        </x-custom.table.responsive.table>



        <x-custom.table.responsive.table-grid>
            @foreach($maps as $map)
                <x-custom.table.responsive.table-grid-inhalt>
                    <ul role="list" class="space-y-1 text-sm">
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">ID:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $map['id'] }}</div>
                        </li>
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">Author:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $map['md_author'] }}</div>
                        </li>
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">Version:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">
                                <x-custom.badge.badge color="purple">{{ $map['md_version'] }}</x-custom.badge.badge>
                            </div>
                        </li>
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">Map:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $map['md_title'][$lang] . ' / ('.$map['md_title']['en'].')' }}</div>
                        </li>
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">Beschreibung:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $map['md_desc'][$lang] }}</div>
                        </li>
                        <li class="flex space-x-3 items-center">
                            <div class="flex-shrink-0">Felder:</div>
                            <div class="text-sm font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $map['md_fields'] }}</div>
                        </li>
                    </ul>
                    <div>
                        <div class="flex justify-end text-right mr-2">
                            @if(auth()->user()->projectMapID() == $map['id'])
                                <x-custom.badge.icon-badge>
                                    <svg class="w-2.5 h-2.5 text-green-800 dark:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                </x-custom.badge.icon-badge>
                            @else
                                @livewire('button.map-change-button', ['mapID' => $map['id']])
                            @endif
                        </div>
                    </div>
                </x-custom.table.responsive.table-grid-inhalt>
            @endforeach
        </x-custom.table.responsive.table-grid>

    </x-custom.main.head>
</x-app-layout>
