@props(["tags"])

@php
$tagsArray = explode(", ", $tags)
@endphp

<ul {{$attributes->merge(["class" => "mt-2"])}}>
    @foreach ($tagsArray as $tag)
    <x-tag>
        {{$tag}}
    </x-tag>
    @endforeach
</ul>
