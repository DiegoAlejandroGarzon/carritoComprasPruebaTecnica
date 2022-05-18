<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Role::create(['name' => 'Administrator','guard_name' => 'web']);
        Role::create(['name' => 'Cliente','guard_name' => 'web']);

        $user = User::create([
            'name'=>'usuario superAdmin',
            'email'=>'superAdmin@admin.com',
            'password'=>Hash::make('12345678'),
        ]);
        $user->assignRole('Administrator');
    }
}
