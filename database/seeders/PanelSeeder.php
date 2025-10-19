<?php

namespace Database\Seeders;

use App\Models\Panel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PanelSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $role = Role::firstOrCreate(['name' => 'admin']);
        $admin->assignRole($role);

        $panel = Panel::query()->firstOrCreate(
            ['slug' => 'default'],
            [
                'name' => 'پنل پیش‌فرض',
                'description' => 'نمونه‌ای برای شروع سریع',
                'metadata' => [
                    'locale' => 'fa',
                ],
            ]
        );

        $panel->users()->syncWithoutDetaching([
            $admin->id => ['role' => 'owner'],
        ]);
    }
}
