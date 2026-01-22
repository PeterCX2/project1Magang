@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-4 shadow-lg bg-white border-gray-100 border p-10 rounded-xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-black">Categories List</h1>
        <a href="{{ route('admin.createCategory') }}" class="inline-block px-4 py-2 font-medium px-3 py-2 text-white bg-blue-600 rounded hover:bg-blue-500">
            Add Category
        </a>        
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <table class="min-w-full divide-y bg-white divide-gray-200 shadow-md rounded-xl p-10">
        <thead>
            <tr class="text-sm font-medium text-[#101010] opacity-75 uppercase">
                <th class="px-6 py-3 text-left tracking-wider">ID</th>
                <th class="px-6 py-3 text-left tracking-wider">Category</th>
                <th class="px-6 py-3 text-left tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($categories as $category)
                <tr class="font-medium text-gray-500 opacity-90">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.deleteCategory', $category->id) }}" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection