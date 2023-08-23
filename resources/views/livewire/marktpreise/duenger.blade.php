<div>
    <div class="p-4">
        <div class="grid grid-cols-1 xl:grid-cols-3 pb-0 gap-4">
            {{-- Left --}}
            <div class="col-span-3">
                <x-custom.card.head class="!mb-0 h-full">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Marktpreise für Duenger / Saatgut (pro 1000 l)</h3>
                    <div class="grid gap-6 mb-6 xl:grid-cols-3">
                        <div class="col-span-1">
                            <x-custom.forms.select-form-with-label id="modi" wire:model="modi">
                                <option value="Leicht">{{ __('Light') }}</option>
                                <option value="Mittel">{{ __('Medium') }}</option>
                                <option value="Schwer">{{ __('Difficult') }}</option>
                            </x-custom.forms.select-form-with-label>
                        </div>
                        <div class="col-span-3">
                            <x-custom.table.responsive.table class="!overflow-x-auto !overflow-y-hidden">
                                <x-custom.table.responsive.thead>
                                    <tr>
                                        <x-custom.table.responsive.th :text="__('Fruit')"/>
                                        @foreach(months()['short'] as $month)
                                            <x-custom.table.responsive.th class="text-center" :text="__('months.'.$month)"/>
                                        @endforeach
                                        <x-custom.table.responsive.th class="text-center" :text="__('Price'). ' / ' . __('Liter')"/>
                                        <x-custom.table.responsive.th class="text-center" :text="__('Regular price')"/>
                                        <x-custom.table.responsive.th class="text-center" :text="__('Maximum price')"/>
                                    </tr>
                                </x-custom.table.responsive.thead>
                                <x-custom.table.responsive.tbody>
                                    {{--@foreach($feldfruechte as $fruit => $fillType)
                                        <x-custom.table.responsive.tr>
                                            <x-custom.table.responsive.td text="{{ __($fillType['name']) }}"/>
                                            @foreach($fillType['factor'] as $index => $factor)
                                                <x-custom.table.responsive.td class="text-center border-x dark:border-gray-700 {{ $factor === $fillType['min'] ? 'bg-red-700 text-white' :
                                                ($factor === $fillType['max'] ? 'bg-green-700 text-white' :
                                                ($factor === $fillType['normal'] ? 'bg-yellow-700 text-white' : ''))
                                                }}" text="{{ numberFormat($factor) }}"/>
                                            @endforeach
                                            <x-custom.table.responsive.td class="text-center" text="{{ numberFormat($fillType['perLiter']) }}"/>
                                            <x-custom.table.responsive.td class="text-center" text="{{ numberFormat($fillType['normal']) }}"/>
                                            <x-custom.table.responsive.td class="text-center" text="{{ numberFormat($fillType['max']) }}"/>
                                        </x-custom.table.responsive.tr>
                                    @endforeach--}}
                                </x-custom.table.responsive.tbody>
                            </x-custom.table.responsive.table>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
        </div>
    </div>
</div>
