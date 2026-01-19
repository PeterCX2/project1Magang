@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 w-auto">
        @foreach ($categories as $category)
            @if ($category->films->count() >= 1)
                <h2 class="text-2xl font-semibold">{{ $category->name }}</h2>
                <div class=" flex flex-nowrap overflow-auto gap-4 mb-6">
                    @for ($i = 0 ; $i < $category->films->count(); $i++)
                        <div class="bg-white shadow rounded-lg p-6 mb-4 w-100 h-min flex flex-col items-center space-y-4">
                            <a href="{{ $category->films[$i]->link }}" target="_blank" class="">
                                @php
                                    $link = $category->films[$i]->link;
                                    $isYoutube = str_contains($link, 'youtube.com') || str_contains($link, 'youtu.be');
                                @endphp
                                @if($isYoutube)
                                    <img 
                                        src="https://img.youtube.com/vi/{{ substr($link, strpos($link, 'v=') + 2) }}/maxresdefault.jpg" class="w-[300px] h-[170px] object-cover">
                                @else
                                    <img class="w-[300px] h-[170px] object-cover" src="{{ asset('image/noImage.png') }}" alt="">
                                @endif
                                <p class="text-lg font-bold text-gray-800 w-72 truncate">{{ $category->films[$i]->title }}</p>
                                <p class="text-sm text-gray-600 truncate w-72">{{ $category->films[$i]->description }}</p>
                                <p class="text-sm text-gray-500">Publisher: {{ $category->films[$i]->publisher }}</p>
                                <p class="text-sm text-gray-500">Release Date: {{ $category->films[$i]->release_date }}</p>
                            </a>
                        </div>
                    @endfor
                </div>
            @endif
        @endforeach
    </div>
@endsection