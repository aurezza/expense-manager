<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddType extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable('users')) {
      Schema::table('users', function (Blueprint $table) {
        $table->integer('role_id')->default(0)->after('email_verified_at');
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if (Schema::hasTable('users') && Schema::hasColumn('users', 'type')) {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role_id');
      });
    }
  }
}
