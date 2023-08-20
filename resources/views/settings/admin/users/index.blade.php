@php use Carbon\Carbon; @endphp
<x-app-layout>
    <div class="p-4">
        @include('settings.layouts.menu')
        <div class="block sm:flex items-center justify-between">
            <div class="w-full mb-1">
                <div class="mb-4">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Invite team member') }}</h1>
                </div>
            </div>
        </div>
        <x-custom.main.head>
            <x-custom.card.head>
                <form method="POST" action="{{ route('settings.admin.users.store') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-custom.forms.small-form-with-label id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" :text="__('Email')" required/>
                    </div>

                    <div class="flex">
                        <x-custom.button.button type="submit">
                            {{ __('Send Invitation') }}
                        </x-custom.button.button>
                    </div>
                </form>
            </x-custom.card.head>

            <x-custom.card.head>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3 text-left">{{ __('Email') }}</th>
                    <th scope="col" class="px-6 py-3 text-left">{{ __('Sent on') }}</th>
                    <th scope="col" class="px-6 py-3 text-left">{{ __('accepted on') }}</th>
                    </thead>
                    <tbody>
                    @foreach ($invitations as $invitation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $invitation->email }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ Carbon::parse($invitation->created_at)->format('d. M. Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $invitation->acceptedat() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-custom.card.head>
        </x-custom.main.head>
    </div>
</x-app-layout>
