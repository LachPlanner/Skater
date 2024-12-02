<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    private int $randomPasswordLength = 32;

    private array $admins = [];

    public function __construct()
    {
        // Tilføj administratorer her
        $this->addAdmin('admin1@example.com', 'Admin', 'User', 'password');
        $this->addAdmin('admin2@example.com', 'Super', 'Admin', 'password');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdmins();
    }

    private function createAdmins(): void
    {
        foreach ($this->admins as $adminDetails) {
            Admin::firstOrCreate(
                ['email' => $adminDetails['email']],
                [
                    'first_name'        => $adminDetails['first_name'],
                    'last_name'         => $adminDetails['last_name'],
                    'password'          => $adminDetails['password'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }

    private function addAdmin(
        string $email,
        string $firstName,
        string $lastName,
        ?string $password = null
    ): self {
        $this->admins[] = [
            'email'      => $email,
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'password'   => $password ? Hash::make($password) : Hash::make(Str::random($this->randomPasswordLength)),
        ];

        return $this;
    }
}
