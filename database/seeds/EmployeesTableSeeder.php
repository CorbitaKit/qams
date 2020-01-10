<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'name' => "Jomar Enrico Antonio",
            'email' => "jomar.antonio@flatworld.com.ph",
            'employee_id' => 13659,
            'role_id' => 1
            
        ]);


         DB::table('employees')->insert([
            'name' => "Kit Corbita",
            'email' => "kit.corbita@flatworld.com.ph",
            'employee_id' => 13675,
            'role_id' => 1
            
        ]);


        DB::table('employees')->insert([
            'name' => "D'Artagnan Jr. Suyo",
            'email' => "bong.suyo@flatworldsolutions.com.ph",
            'employee_id' => 13199,
            'role_id' => 1
            
        ]);
    }
}
