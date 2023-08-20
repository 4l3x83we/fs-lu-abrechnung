@php use App\Models\User; @endphp
@php use Carbon\Carbon; @endphp
<x-app-layout>
    <div class="p-4">
        <div class="block sm:flex items-center justify-between">
            <div class="w-full mb-1">
                <div class="items-center justify-between block sm:flex">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Notes') }}</h1>
                    </div>
                    <livewire:projects.notes.notes-create/>
                </div>
            </div>
        </div>
    </div>
    <x-custom.main.head>
        <div class="mx-auto container p-4">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                @foreach($notes as $note)
                    <div class="rounded">
                        <div class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded border border-gray-200 py-5 px-4">
                            <div>
                                <h4 class="text-gray-800 dark:text-gray-100 font-bold mb-3">{{ User::find($note->user_id)->name }}</h4>
                                <p class="text-gray-800 dark:text-gray-100 text-sm">{!! Str::limit(nl2br($note->notes), 255) !!}</p>
                            </div>
                            <div>
                                <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
                                    <p class="text-sm">{{ Carbon::parse($note->created_at)->format('d. M. Y') }}</p>
                                    <div class="flex">
                                        @if($note->user_id === auth()->id() or is_owner())
                                            <a href="{{ route('project.notes.edit', $note->id) }}" class="text-blue-500 hover:text-blue-600 flex items-center justify-center duration-300 mr-4 last:mr-0" aria-label="edit note" role="button">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                    <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                                    <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('project.notes.show', $note->id) }}" class="text-purple-500 hover:text-purple-600 flex items-center justify-center duration-300 mr-4 last:mr-0" aria-label="show note" role="button">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
                                                </g>
                                            </svg>
                                        </a>
                                        @if($note->user_id === auth()->id() or is_owner())
                                            <form action="{{ route('project.notes.destroy', $note->id) }}" method="POST" class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <x-custom.button.link type="submit" class="text-red-500 hover:text-red-600 flex items-center justify-center duration-300 mr-4 last:mr-0" aria-label="delete note" role="button">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                                    </svg>
                                                </x-custom.button.link>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-custom.main.head>
</x-app-layout>
