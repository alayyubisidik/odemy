@props(['messages'])

@if ($messages)
    @foreach ((array)$messages as $message)
        <span style="margin-bottom: 1px" class="text-danger d-block {{ $attributes->get('class') }}">
            {{ $message }}
        </span>
    @endforeach
@endif
