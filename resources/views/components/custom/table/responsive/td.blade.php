<td {{ $attributes->merge(['class' => 'p-2 text-base whitespace-nowrap'])  }}>
    {{ $text ?? $slot }}
</td>
