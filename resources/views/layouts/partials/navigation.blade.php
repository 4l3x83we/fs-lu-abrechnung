@php use App\Models\User; @endphp
<nav class="fixed z-30 w-full bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-200 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex ml-2 md:mr-24">
                    @if(auth()->user()->projectImage())
                        <img src="{{ asset(auth()->user()->projectImage()) }}" class="h-8 mr-3" alt="Teams Logo"/>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white hidden lg:block">{{ auth()->user()->projectName() ?? 'LU Abrechnung' }}</span>
                    @else
                        <div class="mb-4 rounded w-8 h-8 sm:mb-0 xl:mb-4 2xl:mb-0 dark:text-gray-200 dark:hover:bg-gray-700 bg-gray-200 dark:bg-gray-700 leading-none mr-3">
                            <div class="flex justify-center items-center w-8 h-8 font-bold text-base">
                                {{ initialsAll(auth()->user()->projectName()) }}
                            </div>
                        </div>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white hidden lg:block">{{ auth()->user()->projectName() ?? 'LU Abrechnung' }}</span>
                    @endif
                </a>
            </div>
            <div class="flex items-center">
                <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Dark Mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <!-- Profile -->
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
                            <span class="sr-only">Open user menu</span>
                            @if(auth()->user()->image)
                                <img class="w-8 h-8 rounded-full object-cover object-center" src="{{ asset(auth()->user()->image) }}" alt="user photo">
                            @else
                                <div class="rounded-full w-8 h-8 dark:text-gray-200 dark:hover:bg-gray-700 bg-gray-200 dark:bg-gray-700 leading-none">
                                    <div class="flex justify-center items-center w-8 h-8 font-bold">
                                        {{ initials(auth()->user()) }}
                                    </div>
                                </div>
                            @endif
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-gray-50 divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 w-52" id="dropdown-2">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            @if(auth()->user()->teams()->count() > 0)
                                @foreach(auth()->user()->teams as $team)
                                    @foreach($team->projects as $project)
                                        <li>
                                            <a class="{{ (auth()->user()->current_project_id == $project->id) ? 'font-bold' : '' }} block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('projects.change', $project->id) }}">
                                                {{ $project->project_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endforeach
                            @endif
                        </ul>
                        <ul class="py-1" role="none">
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
