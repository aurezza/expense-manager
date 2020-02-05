<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::updateOrCreate(
          [
              'id' => 1,
              'name' => 'Administrator',
          ],
          [
              'description' => 'Super User'
          ]
      );
    }
}
