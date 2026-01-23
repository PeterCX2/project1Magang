@extends('layouts.app')
@section('title', 'Admin User Dashboard')

@section('content')
<div class="mb-4 shadow-lg bg-white border-gray-100 border p-10 rounded-xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-black">Users List</h1>
        <a href="{{ route('admin.createUser') }}" class="inline-block px-4 py-2 font-medium px-3 py-2 text-white bg-blue-600 rounded hover:bg-blue-500">
            Add New User
        </a>        
    </div>

    <div class="my-4">
        {{ $users->links() }}
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y bg-white divide-gray-200 shadow-md rounded-xl p-10">
            <thead>
                <tr class="text-sm font-medium text-[#101010] opacity-75 uppercase">
                    <th class="px-6 py-3 text-left tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="font-medium text-gray-500 opacity-90">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            <a href="{{ route('admin.editUser', $user->id) }}" class="px-3 py-2 text-white bg-blue-600 rounded hover:bg-blue-500">Edit</a>
                            <a href="{{ route('admin.deleteUser', $user->id) }}" class="ml-2 px-3 py-2 text-white bg-red-600 rounded hover:bg-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
