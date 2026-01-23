@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-[black] mb-6">Add Video</h1>

  <form class="grid grid-cols-1 gap-6" method="post" action="{{ route('admin.storeCategory') }}">
    @csrf
    <div class="p-2">
        <label for="name">Category Name</label>
        <input placeholder="e.g. horror" type="text" id="name" name="name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#8c0327] focus:ring-[#8c0327] focus:ring-opacity-50 p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">
        Add Category
      </button>
    </div>
  </form>
</div>
@endsection