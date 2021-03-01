<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
            'acc_type' => 'superadmin',
            'role_access' => 'Add User,User List,Academic Year,Document,Standard,Section,Class,New Junior Admission,Junior Admission List,New School Admission,School Admission List,New Allotment,Allotment List,Junior College Certificate,Primary School Certificate,Fee Head,Add Fee,Pay Fee,Visitor Registration,Inward Document,Outward Document',
        ]);
    }
}
