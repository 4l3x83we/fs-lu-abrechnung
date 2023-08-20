<x-custom.nav.tabs id="settingsTab">
    <x-custom.nav.tabs-li request="settings/admin/maps*" :route="route('settings.admin.maps.index')">{{ __('Maps') }}</x-custom.nav.tabs-li>
    <x-custom.nav.tabs-li request="settings/admin/users*" :route="route('settings.admin.users.index')">{{ __('Invite') }}</x-custom.nav.tabs-li>
{{--    <x-custom.nav.tabs-li request="settings/admin/users*" :route="route('settings.admin.users.index')">{{ __('Users') }}</x-custom.nav.tabs-li>--}}
{{--    <x-custom.nav.tabs-li request="settings/admin/roles*" :route="route('settings.admin.roles.index')">{{ __('Roles') }}</x-custom.nav.tabs-li>--}}
{{--    <x-custom.nav.tabs-li request="settings/admin/permission*" :route="route('settings.admin.permission.index')">{{ __('Permission') }}</x-custom.nav.tabs-li>--}}
</x-custom.nav.tabs>
