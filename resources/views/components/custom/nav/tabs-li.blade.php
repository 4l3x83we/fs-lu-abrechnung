<li class="mr-2">
    @if(Request::is($request ?? ''))
        <a href="{{ $route ?? '' }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-primary-600 border-primary-600 dark:text-primary-500 dark:border-primary-500 " aria-current="page">
            {{ $slot ?? '' }}
        </a>
    @else
        <a href="{{ $route ?? '' }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            {{ $slot ?? '' }}
        </a>
    @endif
</li>
