<a href="{{ $href ?? '#' }}" {{ $attributes->merge(['class' => 'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700']) }}>{{ $slot }}</a>

