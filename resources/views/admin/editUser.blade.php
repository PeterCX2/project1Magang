@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-black mb-6">Edit User</h1>

  <form class="grid grid-cols-1 gap-6" method="POST" action="{{ route('admin.updateUser', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="p-2">
        <label for="name">Name</label>
        <input value="{{ old('name', $user->name) }}" type="text" id="name" name="name" class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Email -->
    <div class="p-2">
        <label for="email">Email</label>
        <input value="{{ old('email', $user->email) }}" type="email" id="email" name="email" class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Role -->
    <div class="p-2">
        <label for="role">Role</label>
        <select name="role" id="role" class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Password (optional) -->
    <div class="p-2">
        <label for="password">
            Password <span class="text-sm text-gray-500">(leave blank if unchanged)</span>
        </label>
        <input type="password" id="password" name="password" class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Confirm Password -->
    <div class="p-2">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Submit -->
    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">Update User</button>
    </div>
  </form>
</div>
@endsection
