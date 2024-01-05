@section('title', 'Diskon Besar Besaran')

@props(['rows'])

<x-app-layout>
    <div class="grid grid-cols-5 gap-4">
        @foreach ($rows as $row)
            <x-product-card :product="$row"/>
        @endforeach
    </div>
</x-app-layout>
