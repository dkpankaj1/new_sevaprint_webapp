<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateProject extends Command
{
    // The name and signature of the console command.
    protected $signature = 'project:update'; // This defines the name of the command

    // The console command description.
    protected $description = 'Update the project from GitHub'; // Description for the command

    // Create a new command instance.
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        // Check if the application is not in production
        if (app()->environment() !== 'production') {
            $this->info('Updating project...');

            // Example: Execute shell command to pull from GitHub
            // exec('git pull origin main', $output, $status);
            $status = 0;

            // Check if the pull was successful
            if ($status === 0) {
                $this->info('Project updated successfully!');
            } else {
                $this->error('Failed to update project.');
            }
        } else {
            $this->error('Cannot update project in production environment.');
        }
    }

}
