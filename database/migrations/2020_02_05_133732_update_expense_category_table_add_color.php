<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExpenseCategoryTableAddColor extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable('expense_categories')) {
      Schema::table('expense_categories', function (Blueprint $table) {
        $table->string('color')->default('')->after('description');
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
    if (Schema::hasTable('expense_categories') && Schema::hasColumn('expense_categories', 'color')) {
      Schema::table('expense_categories', function (Blueprint $table) {
        $table->dropColumn('color');
      });
    }
  }
}
