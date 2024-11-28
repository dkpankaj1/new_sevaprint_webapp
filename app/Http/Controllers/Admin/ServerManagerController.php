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
    public function migrateFresh()
    {
        if (app()->environment('production')) {
            $notification = ['message' => "This action is not allowed in the production environment.", 'type' => "error"];
            return redirect()->back()->with($notification);
        }

        try {
            Artisan::call('migrate:fresh', [
                '--seed' => true, // Seed after refreshing migrations
                '--force' => true // Forces the command to run without confirmation
            ]);

            $notification = ['message' => "Database refreshed and seeded successfully.", 'type' => "success"];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => "error"];
            return redirect()->back()->with($notification);
        }
    }

    public function updateProject()
    {
        // Check if the application is not in production
        if (app()->environment() !== 'production') {
            // Call the custom Artisan command
            Artisan::call('project:update');

            // Redirect with a success message
            $notification = ['message' => "Project update is in progress.", 'type' => "success"];
            return redirect()->back()->with($notification);
        } else {
            // If in production, show an error or alternative message
            $notification = ['message' => 'Cannot update project in the production environment.', 'type' => "error"];
            return redirect()->back()->with($notification);
        }
    }



}
