@extends('layouts.app')
@section('title', 'Changes Details')

@section('content')
<div class="mb-4 shadow-lg bg-white border-gray-100 border p-10 rounded-xl">
    <div class="w-full flex flex-col justify-center items-start mb-6">
        <a class="text-2xl font-bold text-black" href="{{ route('admin.audits') }}"><--Back</a>
        <h1 class="text-lg font-bold text-black">{{class_basename($audit->auditable_type) . ' was ' . $audit->event . ' by ' . ($audit->user->name ?? 'system') . ' at ' . $audit->created_at}}</h1>
    </div>

    <div class="overflow-x-auto">
        <div class="space-y-3 text-sm">
            <div>
                <div class="font-semibold text-gray-700 mb-1">Old Values</div>
                <pre class="bg-red-50 text-red-700 p-3 rounded overflow-x-auto">
                    {{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}
                </pre>
            </div>

            <div>
                <div class="font-semibold text-gray-700 mb-1">New Values</div>
                <pre class="bg-green-50 text-green-700 p-3 rounded overflow-x-auto">
                    {{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}
                </pre>
            </div>
        </div>
    </div>
</div>
@endsection