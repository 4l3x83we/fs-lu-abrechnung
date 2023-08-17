<x-app-layout>
    <x-custom.main.head>
        <x-custom.card.head>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                </div>

                <div class="flex mt-4">
                    <x-primary-button>
                        {{ __('Send Invitation') }}
                    </x-primary-button>
                </div>
            </form>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-8">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th scope="col" class="px-6 py-3 text-left">{{ __('Email') }}</th>
                <th scope="col" class="px-6 py-3 text-left">{{ __('Sent on') }}</th>
                </thead>
                <tbody>
                @foreach ($invitations as $invitation)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $invitation->email }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $invitation->created_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-custom.card.head>
    </x-custom.main.head>
</x-app-layout>
