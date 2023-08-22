<div {{ $attributes->merge(['class' => 'overflow-auto shadow hidden md:block']) }}>
    <table class="w-full">
        {{ $slot }}
    </table>
</div>
