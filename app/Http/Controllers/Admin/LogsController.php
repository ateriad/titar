<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LogsController extends Controller
{
    public function index()
    {
        $logFile = file(storage_path() . '/logs/laravel.log');
        $logs = [];

        foreach ($logFile as $lineNum => $line) {
            $logs[] = htmlspecialchars($line);
        }

        return view('pages.admin.logs.index', [
            'logs' => $logs
        ]);
    }
}
