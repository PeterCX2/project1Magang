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

    <!-- Roles -->
    <div class="p-2">
        <label for="roles" class="font-semibold">Roles</label>
        <select name="roles[]" id="roles" multiple class="block w-full rounded-md border-gray-300 shadow-sm p-2 border-2" style="background-color: #f6f6f6;">
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ in_array($role->name, old('roles', [])) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>


    <label class="font-semibold">Permissions</label>
    <div class="grid grid-flow-col grid-rows-4 gap-x-12 gap-y-2 bg-gray-100 p-5 rounded-xl">
    @foreach ($permissions as $permission)
        @php
            $group =
                str_contains($permission->name, 'user') ? 'user' :
                (str_contains($permission->name, 'create') ? 'create' :
                (str_contains($permission->name, 'edit') ? 'edit' :
                (str_contains($permission->name, 'delete') ? 'delete' : 'other')));
        @endphp

        <label class="flex items-center space-x-2 whitespace-nowrap permission-item" data-group="{{ $group }}">
            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
            <span>{{ $permission->name }}</span>
        </label>
    @endforeach
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
<script>
$(document).ready(function () {
    $('#roles').select2({placeholder:"Pilih roles",allowClear:true,width:'100%'});
    function togglePermissions() {
        // ambil semua role yang dipilih
        let roles = $('#roles').val() || []; // array

        if (roles.includes('admin')) {
            $('.permission-item').removeClass('hidden');
            return; // stop di sini
        }

        $('.permission-item').each(function () {
            let group = $(this).data('group');
            $(this).removeClass('hidden');
            // contoh rule:
            // user tidak boleh create, edit, delete film, akun, dan category
            // film creator tidak boleh akses akun
            if (roles.includes('film creator') && group === 'user') {
                $(this).addClass('hidden');
                $(this).find('input').prop('checked', false);
            } 
            
            if (roles.includes('user') && !roles.includes('film creator') && (group === 'user' || group === 'create' || group === 'edit' || group === 'delete')) {
                $(this).addClass('hidden');
                $(this).find('input').prop('checked', false);
            }
        });
    }

    // event change
    $('#roles').on('change', togglePermissions);

    // run on load (old input / edit)
    togglePermissions();
});
</script>

@endsection
