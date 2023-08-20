<x-app-layout>
    <div class="p-4">
        @include('settings.layouts.menu')
        <div class="block sm:flex items-center justify-between">
            <div class="w-full mb-6">
                <div class="items-center justify-between block sm:flex">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Create map') }}</h1>
                    </div>
                    <x-custom.button.link-a href="{{ route('settings.admin.maps.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 duration-300">
                        <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                        </svg>
                        {{ __('Back') }}
                    </x-custom.button.link-a>
                </div>
            </div>
        </div>
        <x-custom.main.head>
            <form action="{{ route('settings.admin.maps.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 xl:grid-cols-2 pb-0 gap-4">
                    {{-- Left --}}
                    <div class="col-span-1">
                    <x-custom.card.head class="!mb-0">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Map Icon') . ' (.dds)' }}</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 border-gray-200 dark:hover:bg-gray-500 dark:hover:border-gray-600 dark:border-gray-700">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">{{ __('Select a Map Icon') }}</p>
                                    </div>
                                    <input type="file" class="opacity-0" name="md_icon">
                                </label>
                            </div>
                        </div>
                    </x-custom.card.head>
                    </div>
                    {{-- Right --}}
                    <div class="col-span-1">
                    <x-custom.card.head class="!mb-0">
                        <div class="mt-4">
                            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-200 dark:focus:ring-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:border-neutral-600 dark:hover:text-white dark:hover:bg-neutral-700">Speichern</button>
                        </div>
                    </x-custom.card.head>
                    </div>
                </div>
            </form>
        </x-custom.main.head>
    </div>
</x-app-layout>
