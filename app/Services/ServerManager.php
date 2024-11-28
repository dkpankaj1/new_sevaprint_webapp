<?php

namespace App\Services;

class ServerManager
{
    // Get server uptime
    public function getUptime()
    {
        return shell_exec('uptime');
    }

    // Get CPU usage
    public function getCpuUsage()
    {
        if (stristr(PHP_OS, 'win')) {
            return ['1_min' => null, '5_min' => null, '15_min' => null];
        }
        $load = sys_getloadavg();
        return [
            '1_min' => $load[0] ?? null,
            '5_min' => $load[1] ?? null,
            '15_min' => $load[2] ?? null,
        ];
    }

    // Get memory usage
    public function getMemoryUsage()
    {
        $memory = [];
        if (function_exists('memory_get_usage')) {
            $memory['used'] = memory_get_usage();
            $memory['peak'] = memory_get_peak_usage();
        }

        $freeMemory = shell_exec('free -m');
        $memory['free'] = $freeMemory;

        return $memory;
    }

    // Get disk space usage
    public function getDiskUsage()
    {
        return [
            'total' => disk_total_space('/'),
            'free' => disk_free_space('/'),
            'used' => disk_total_space('/') - disk_free_space('/'),
        ];
    }

    // Get current processes
    public function getRunningProcesses()
    {
        return shell_exec('ps aux');
    }

    // Get network statistics
    public function getNetworkStats()
    {
        return shell_exec('netstat -s');
    }
}
