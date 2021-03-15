<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param User $model
     * @return void
     * @throws \Exception
     */
    public function run(User $model)
    {
        $password = Hash::make('testpassword');

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.demo',
            'email_verified_at' => now(),
            'password' => $password
        ]);

        $model::factory(10)->create();
    }

    public function clearTables(User $model): void
    {
        $tableName = $model->getTable();
        DB::table( $tableName )->delete();
        DB::statement("ALTER TABLE `{$tableName}` AUTO_INCREMENT = 1");
    }

}
