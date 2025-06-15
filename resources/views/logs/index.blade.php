<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4">User Login History</h3>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>Login At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loginLogs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->login_at }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">No login history.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $loginLogs->appends(request()->except('login_logs_page'))->links() }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4">Transaction Audit Trail</h3>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($auditLogs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($log->action) }}</span></td>
                                <td>{{ $log->details }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">No audit trail found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $auditLogs->appends(request()->except('audit_logs_page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>