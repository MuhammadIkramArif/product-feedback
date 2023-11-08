<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'superuser']);
        Role::create(['name' => 'customer']);

        $model = new User();
        $model->name = 'Superuser';
        $model->username = 'superuser';
        $model->email = 'superuser@gmail.com';
        $model->password = Hash::make('superuser');
        $model->email_verified_at = now();
        $model->save();
        $model->assignRole('superuser');

    }
}
