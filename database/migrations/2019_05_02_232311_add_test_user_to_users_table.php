<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AddTestUserToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('abcdef9999'),
                'type' => 'Admin'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@admin.com')->delete();
    }
}
