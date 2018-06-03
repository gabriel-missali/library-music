<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::table('users')->insert([
        ['name' => 'Admin', 'email' => 'admin@mail.com', 'password' => '$2y$10$0m9oMQMYga.af9iA43bgFu6g5xMqcmqxND1LYBjKGAWH3B2c4HeCO', 'permission' => 'admin'],
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("DELETE FROM public.users");
    }
}
