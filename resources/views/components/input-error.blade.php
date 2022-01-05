@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 py-4']) }}>{{ $message }}</p>
@enderror