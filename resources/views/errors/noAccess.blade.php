@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="text-center max-w-md">
        <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>

        <h2 class="text-2xl font-semibold mb-2">
            Access Denied
        </h2>

        <p class="text-gray-600 mb-6">
            You do not have permission to access this page.
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block px-6 py-3 bg-[#8c0327] text-white rounded-full hover:bg-[#6b0220] transition">
            Back to Index
        </a>
    </div>
</div>
@endsection
