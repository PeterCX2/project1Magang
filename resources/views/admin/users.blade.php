@extends('layouts.app')
@section('title', 'Admin User Dashboard')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.createUser') }}"
       class="inline-block px-4 py-2 font-medium text-white bg-green-600 rounded-md hover:bg-green-500 transition">
        Add New User
    </a>
</div>

<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->getRoleNames()->implode(', ') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('admin.editUser', $user->id) }}" class="px-3 py-2 text-white bg-blue-600 rounded hover:bg-blue-500">Edit</a>
                    <a href="{{ route('admin.deleteUser', $user->id) }}" class="ml-2 px-3 py-2 text-white bg-red-600 rounded hover:bg-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
