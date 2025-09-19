<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->
        create([
        'name'=>'Darwin',
        'last_name'=>'AlemanSoza',
        'email'=>'soy@admin.com',
        'phone'=>'12345678',
        'role'=>'admin',
        'password'=>Hash::make('password'),        
        ]);
    }
}
