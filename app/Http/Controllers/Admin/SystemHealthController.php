<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SystemHealthController extends Controller
{
    public function index()
    {
        $metrics = [
            'database_size' => $this->getDatabaseSize(),
            'active_users' => $this->getActiveUsers(),
            'system_load' => $this->getSystemLoad(),
            'cache_status' => Cache::get('system_status', 'healthy')
        ];
        
        return view('admin.system-health.index', compact('metrics'));
    }
    
    private function getDatabaseSize()
    {
        return DB::select('SELECT pg_size_pretty(pg_database_size(current_database()))')[0]->pg_size_pretty;
    }
    
    private function getActiveUsers()
    {
        return DB::table('users')
            ->where('last_activity', '>', now()->subMinutes(15))
            ->count();
    }
    
    private function getSystemLoad()
    {
        return sys_getloadavg()[0];
    }
}