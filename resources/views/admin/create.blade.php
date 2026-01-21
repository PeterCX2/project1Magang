@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-[black] mb-6">Add Video</h1>

  <form class="grid grid-cols-1 gap-6" method="post" action="{{ route('admin.store') }}">
    @csrf
    <!-- Title -->
    <div class="p-2">
        <label for="link">Video Link</label>
        <input placeholder="..." type="text" id="link" name="link" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>
    <div class="p-2">
        <label for="category_id">Video category</label>
        <select required name="category_id" id="category_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2 text-gray-400" style="background-color: #f6f6f6;" onchange="this.classList.remove('text-gray-400')">
            <option value="" disabled selected hidden>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="p-2">
        <label for="title">Video Title</label>
        <input placeholder="..." type="text" id="title" name="title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>
    <div class="p-2">
        <label for="description">Video Description</label>
        <input placeholder="..." type="text" id="description" name="description" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>
    <div class="p-2">
        <label for="publisher">Publisher</label>
        <input placeholder="..." type="text" id="publisher" name="publisher" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>
    <div class="p-2">
        <label for="release_date">Release Date</label>
        <input placeholder="..." type="date" id="release_date" name="release_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">
        Add Video
      </button>
    </div>
  </form>
</div>
@endsection