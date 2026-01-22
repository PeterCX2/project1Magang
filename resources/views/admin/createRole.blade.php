@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-black mb-6">Create Role</h1>

  <form class="grid grid-cols-1 gap-6" method="POST" action="{{ route('admin.storeRole') }}">
    @csrf

    <!-- Name -->
    <div class="p-2">
        <label for="name">Name</label>
        <input value="{{ old('name') }}" type="text" id="name" name="name" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <label class="font-semibold">Permissions</label>
    <div class="grid grid-flow-col grid-rows-4 gap-x-12 gap-y-2 bg-gray-100 p-5 rounded-xl">
    @foreach ($permissions as $permission)
        <label class="flex items-center space-x-2 whitespace-nowrap permission-item">
            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
            <span>{{ $permission->name }}</span>
        </label>
    @endforeach
    </div>

    <!-- Submit -->
    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">Create Role</button>
    </div>
  </form>
</div>
@endsection
