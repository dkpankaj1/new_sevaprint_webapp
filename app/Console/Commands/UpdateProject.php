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
    // public function handle()
    // {
    //     // Check if the application is not in production
    //     if (app()->environment() !== 'production') {
    //         $this->info('Updating project...');

    //         // Example: Execute shell command to pull from GitHub
    //         exec('git pull origin main', $output, $status);

    //         // Check if the pull was successful
    //         if ($status === 0) {
    //             $this->info('Project updated successfully!');
    //         } else {
    //             $this->error('Failed to update project.');
    //         }
    //     } else {
    //         $this->error('Cannot update project in production environment.');
    //     }
    // }

    public function handle()
    {
        // Check if the application is not in production
        if (app()->environment() !== 'production') {
            $this->info('Updating project...');

            // Step 1: Pull the latest changes from GitHub
            exec('git pull origin main', $output, $status);

            // Check if the pull was successful
            if ($status === 0) {
                $this->info('Project updated successfully!');

                // Step 2: Check if Composer is installed
                $this->info('Checking if Composer is installed...');
                exec('composer --version', $composerCheckOutput, $composerCheckStatus);

                if ($composerCheckStatus !== 0) {
                    $this->info('Composer is not installed. Installing Composer...');

                    // Step 3: Install Composer
                    exec('php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"', $installOutput, $installStatus);
                    if ($installStatus === 0) {
                        exec('php composer-setup.php', $setupOutput, $setupStatus);

                        // Verify the installation by checking if composer.phar exists
                        exec('php -r "unlink(\'composer-setup.php\');"', $cleanupOutput, $cleanupStatus);

                        // Verify the composer installation
                        exec('php composer.phar --version', $composerInstallVerifyOutput, $composerInstallVerifyStatus);
                        if ($composerInstallVerifyStatus === 0) {
                            $this->info('Composer installed successfully!');
                        } else {
                            $this->error('Failed to verify Composer installation.');
                            return;
                        }
                    } else {
                        $this->error('Failed to download the Composer installer.');
                        return;
                    }
                } else {
                    $this->info('Composer is already installed.');
                }

                // Step 4: Install/update Composer dependencies
                $this->info('Updating Composer dependencies...');
                exec('php composer.phar install --no-interaction --optimize-autoloader', $composerOutput, $composerStatus);

                // Check if Composer update was successful
                if ($composerStatus === 0) {
                    $this->info('Composer dependencies updated successfully!');

                    // Step 5: Run migrate:fresh --seed
                    $this->info('Running database migrations...');
                    exec('php artisan migrate:fresh --seed', $migrateOutput, $migrateStatus);

                    // Check if migrations were successful
                    if ($migrateStatus === 0) {
                        $this->info('Database migrated and seeded successfully!');
                    } else {
                        $this->error('Failed to migrate the database.');
                    }
                } else {
                    $this->error('Failed to update Composer dependencies.');
                }
            } else {
                $this->error('Failed to update project. Git pull was not successful.');
            }
        } else {
            $this->error('Cannot update project in production environment.');
        }
    }



}
