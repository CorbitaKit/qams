<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'account_name' => "Account 1",
            'is_custom' => 0
        ]);

         DB::table('accounts')->insert([
            'account_name' => "Account 2",
            'is_custom' => 0
        ]);

        DB::table('accounts')->insert([
            'account_name' => "Account 3",
            'is_custom' => 0
        ]);

        DB::table('accounts')->insert([
            'account_name' => "Account 4",
            'is_custom' => 0
        ]);

        DB::table('accounts')->insert([
            'is_custom' => 0,
            'account_name' => "Account 5",
        ]);
    }
}
