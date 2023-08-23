<x-custom.nav.tabs id="settingsTab">
    <x-custom.nav.tabs-li request="project/marktpreise/feldfruechte*" :route="route('project.marktpreise.feldfruechte')">{{ __('Feldfrüchte') }}</x-custom.nav.tabs-li>
    <x-custom.nav.tabs-li request="project/marktpreise/duenger*" :route="route('project.marktpreise.duenger')">{{ __('Dünger/Saatgut') }}</x-custom.nav.tabs-li>
</x-custom.nav.tabs>
