@extends('layouts.app')
@section('content')
@php
$actions = ['view', 'create', 'edit', 'delete'];

$resources = [];
foreach ($permissions as $permission) {
    [$action, $resource] = explode(' ', $permission->name, 2);
    $resources[$resource][] = $action;
}
@endphp

<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-black mb-6">Edit Role</h1>

  <form class="grid grid-cols-1 gap-6" method="POST" action="{{ route('admin.updateRole', $role->id) }}">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="p-2">
        <label for="name">Name</label>
        <input placeholder="e.g. content creator" value="{{ old('name', $role->name) }}" type="text" id="name" name="name" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <label class="font-semibold">Permissions</label>
    <div class="grid grid-cols-4 gap-x-12 gap-y-2 bg-gray-100 p-5 rounded-xl">
        @foreach ($resources as $resource => $resourceActions)
            <div class="space-y-2">
                <h3 class="text-xlt font-semibold capitalize text-gray-700">{{ $resource }}</h3>
                @foreach ($actions as $action)
                    @if(in_array($action, $resourceActions))
                    <label class="flex items-center space-x-2 whitespace-nowrap">
                        <input type="checkbox" 
                               name="permissions[]" 
                               value="{{ $action.' '.$resource }}"
                               {{ in_array($action.' '.$resource, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                        <span>{{ ucfirst($action) }}</span>
                    </label>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Submit -->
    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">Update Role</button>
    </div>
  </form>
</div>
@endsection
