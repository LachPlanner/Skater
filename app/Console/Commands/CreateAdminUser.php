<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                            {first_name : The first name of the admin} 
                            {last_name : The last name of the admin} 
                            {email : The email of the admin} 
                            {password : The password of the admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstName = $this->argument('first_name');
        $lastName = $this->argument('last_name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if admin with this email already exists
        if (Admin::where('email', $email)->exists()) {
            $this->error("An admin with the email {$email} already exists.");
            return;
        }

        // Create the admin user
        $admin = Admin::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Admin user '{$admin->first_name} {$admin->last_name}' created successfully!");
    }
}
