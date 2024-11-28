<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ServerManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class ServerManagerController extends Controller
{
    public function index(Request $request)
    {
        $serverManager = new ServerManager();

        if ($request->expectsJson()) {
            return response()->json([
                'uptime' => $serverManager->getUptime(),
                'cpu_usage' => $serverManager->getCpuUsage(),
                'memory_usage' => $serverManager->getMemoryUsage(),
                'disk_usage' => $serverManager->getDiskUsage(),
                'processes' => $serverManager->getRunningProcesses(),
                'network' => $serverManager->getNetworkStats(),
            ]);
        }

        return view('admin.server.index');
    }

    public function storageLink()
    {
        try {
            Artisan::call('storage:link');
            $notification = ['message' => "Storage link success", 'type' => "success"];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => "error"];
            return redirect()->back()->with($notification);
        }
    }

    public function optimize()
    {
        try {
            Artisan::call('optimize');
            $notification = ['message' => "Application optimized successfully.", 'type' => "success"];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => "error"];
            return redirect()->back()->with($notification);
        }
    }

    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            $notification = ['message' => "Application cache cleared successfully.", 'type' => "success"];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => "error"];
            return redirect()->back()->with($notification);
        }
    }
}
