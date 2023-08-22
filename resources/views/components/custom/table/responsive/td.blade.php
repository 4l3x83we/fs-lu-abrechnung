<td {{ $attributes->merge(['class' => 'p-2 text-sm whitespace-nowrap'])  }}>
    {{ $text ?? $slot }}
</td>
