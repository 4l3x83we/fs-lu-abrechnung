<footer class="bg-gray-50 shadow dark:bg-gray-800 border-t border-gray-200 dark:border-gray-600">
    <div class="w-full mx-auto p-4">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center mb-2 sm:mb-0 text-sm text-gray-500 dark:text-gray-400">
                <livewire:helper.clock />
            </div>
            <ul class="flex flex-wrap items-center mb-2 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="{{ route('impressum') }}" class="mr-4 hover:underline md:mr-6 ">Impressum</a>
                </li>
                <li>
                    <a href="{{ route('datenschutz') }}" class="mr-4 hover:underline md:mr-6">Datenschutz</a>
                </li>
                <li>
                    <a href="{{ route('nutzungsbedienungen') }}" class="mr-4 hover:underline md:mr-6 ">Nutzungsbedienungen</a>
                </li>
            </ul>
        </div>
        <hr class="my-2 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-4" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            &copy; @if(date('Y') === '2023') 2023 @else 2023-{{ date('Y') }} @endif <a href="#" class="hover:underline" target="_blank">4l3x83we</a>. All Rights Reserved.
        </span>
    </div>
</footer>

