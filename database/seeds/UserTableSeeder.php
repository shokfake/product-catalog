<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = "Sergey Karpenko";
        $user->email = "shokfake@gmail.com";
        $user->password = Hash::make('123456');
        $user->assignRole('Super Admin');
        $user->save();

        $user = new \App\User();
        $user->name = "Alex Smith";
        $user->email = "alex@gmail.com";
        $user->password = Hash::make('123456');
        $user->assignRole('Admin managers');
        $user->save();

        $user = new \App\User();
        $user->name = "Mike Petrov";
        $user->email = "Mike@gmail.com";
        $user->password = Hash::make('123456');
        $user->assignRole('Admin managers');
        $user->save();

        $user = new \App\User();
        $user->name = "Papa Karlp";
        $user->email = "Papa@gmail.com";
        $user->password = Hash::make('123456');
        $user->assignRole('User');
        $user->save();
    }
}
