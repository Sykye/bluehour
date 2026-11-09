@extends('layouts.app')
@section('title', 'Activity Log')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Activity Log</h1>
    <p class="text-sm text-gray-500 mt-1">Riwayat aktivitas seluruh sistem.</p>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Model</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="text-xs text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    <td>
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-navy-100 flex items-center justify-center text-navy-700 text-xs font-bold">
                                {{ $log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S' }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $log->user?->name ?? 'System' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-blue text-xs font-mono">{{ $log->action }}</span>
                    </td>
                    <td class="text-gray-600">
                        {{ $log->model ?? '-' }}
                        @if($log->model_id)<span class="text-gray-400">#{{ $log->model_id }}</span>@endif
                    </td>
                    <td class="text-xs text-gray-500 max-w-xs">
                        @if($log->data)
                            @foreach($log->data as $key => $val)
                                <span class="font-semibold">{{ $key }}:</span>
                                {{ is_array($val) ? json_encode($val) : $val }}<br>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-10 text-gray-400">Belum ada log aktivitas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($logs, 'links'))
    <div class="px-5 py-4 border-t border-gray-50">{{ $logs->links() }}</div>
    @endif
</div>
@endsection
