@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
  <!-- Page Title -->
  <h1 class="text-3xl font-bold text-black mb-6">Create User</h1>

  <form class="grid grid-cols-1 gap-6" method="POST" action="{{ route('admin.storeUser') }}">
    @csrf

    <!-- Name -->
    <div class="p-2">
        <label for="name">Name</label>
        <input value="{{ old('name') }}" type="text" id="name" name="name" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Email -->
    <div class="p-2">
        <label for="email">Email</label>
        <input value="{{ old('email') }}" type="email" id="email" name="email" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Role -->
    <div class="p-2">
        <label for="role">Role</label>
        <select name="role" id="role" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2 text-gray-400" style="background-color: #f6f6f6;" onchange="this.classList.remove('text-gray-400')">
            <option value="" disabled selected hidden>Select Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Password -->
    <div class="p-2">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Confirm Password -->
    <div class="p-2">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
    </div>

    <!-- Submit -->
    <div class="col-span-full mt-6 p-2">
      <button type="submit" class="block w-full bg-[#8c0327] hover:bg-[#6b0220] text-white font-bold py-3 px-4 rounded-full">Create User</button>
    </div>
  </form>
</div>
@endsection
