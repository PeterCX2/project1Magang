@extends('layouts.app')
@section('title', 'Audits User Dashboard')

@section('content')
<div class="mb-4 shadow-lg bg-white border-gray-100 border p-10 rounded-xl">
    <h1 class="text-3xl font-bold text-black">Categories List</h1>
    <div class="my-4">
        {{ $audits->links() }}
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y bg-white divide-gray-200 shadow-md rounded-xl p-10">
            <thead>
                <tr class="text-sm font-medium text-[#101010] opacity-75 uppercase">
                    <th class="px-6 py-3 text-left tracking-wider">User</th>
                    <th class="px-6 py-3 text-left tracking-wider">Event</th>
                    <th class="px-6 py-3 text-left tracking-wider">Model</th>
                    <th class="px-6 py-3 text-left tracking-wider">Old Values</th>
                    <th class="px-6 py-3 text-left tracking-wider">New Values</th>
                    <th class="px-6 py-3 text-left tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($audits as $audit)
                    <tr class="font-medium text-gray-500 opacity-90">
                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($audit->user)->name ?? 'System' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $audit->event }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ class_basename($audit->auditable_type) }}</td>
                        <td class="px-6 py-4 text-xs"><pre>{{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}</pre></td>
                        <td class="px-6 py-4 text-xs"><pre>{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre></td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $audit->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           <a href="{{ route('admin.deleteAudit', $audit->id) }}" class="ml-2 px-3 py-2 text-white bg-red-600 rounded hover:bg-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
