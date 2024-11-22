<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUsers extends Command
{
    protected $signature = 'users:show';
    protected $description = 'Show all users with their roles';

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $this->info("User: {$user->name} (Email: {$user->email})");
            $this->info("Roles: " . $user->getRoleNames()->join(', '));
            $this->line('-------------------');
        }
    }
}
