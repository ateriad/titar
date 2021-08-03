<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\json_encode;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function run()
    {
        $this->createAdminUser();
    }

    public function createAdminUser()
    {
        $role = new Role();
        $role->title = trans('words.admin');
        $role->permissions = json_encode(array('super-admin'));
        $role->save();

        $user = User::firstOrCreate([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.admin',
            'cellphone' => '09120001234',
            'password' => Hash::make('12345678'),
        ]);

        $user->roles()->save(Role::findOrFail(1));
    }
}
