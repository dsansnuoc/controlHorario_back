<?php

namespace Database\Seeders;

use App\Models\RolesUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       RolesUser::create(['user_id' => 1, 'roles_id' => 1]);
    }
}