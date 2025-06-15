<?php
namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\LoginLog;

class LogViewController extends Controller
{
    public function index()
    {
        $loginLogs = LoginLog::with('user')->latest()->paginate(10, ['*'], 'login_logs_page');
        $auditLogs = AuditLog::with('user')->latest()->paginate(10, ['*'], 'audit_logs_page');

        return view('logs.index', compact('loginLogs', 'auditLogs'));
    }
}