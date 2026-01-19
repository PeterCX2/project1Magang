@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div>
    <a href="{{ route('admin.create') }}" class="mb-4 inline-block px-4 py-2 font-medium text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:shadow-outline-green active:bg-green-600 transition duration-150 ease-in-out">Add New Film</a> 
</div>
<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">title</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">link</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">category</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">publisher</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($films as $film)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $film->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap"><p class="w-[200px] truncate">{{ $film->link }}</p></td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $film->category->name ?? 'None' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $film->publisher }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $film->release_date }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('admin.edit', $film->id) }}" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Edit</a>
                    <a href="{{ route('admin.delete', $film->id) }}" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $films->links() }}
</div>
@endsection