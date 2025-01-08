<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    private int $randomPasswordLength = 32;

    private array $users = [];

    public function __construct()
    {
        // Tilføj brugere her
        $this->addUser('user1@example.com', 'John', 'Doe', 'password');
        $this->addUser('user2@example.com', 'Jane', 'Smith', 'password');
        $this->addUser('user3@example.com', 'Alice', 'Johnson', 'password');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsers();
    }

    private function createUsers(): void
    {
        foreach ($this->users as $userDetails) {
            User::firstOrCreate(
                ['email' => $userDetails['email']],
                [
                    'first_name'        => $userDetails['first_name'],
                    'last_name'         => $userDetails['last_name'],
                    'password'          => $userDetails['password'],
                ]
            );
        }
    }

    private function addUser(
        string $email,
        string $firstName,
        string $lastName,
        ?string $password = null
    ): self {
        $this->users[] = [
            'email'      => $email,
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'password'   => $password ? Hash::make($password) : Hash::make(Str::random($this->randomPasswordLength)),
        ];

        return $this;
    }
}

