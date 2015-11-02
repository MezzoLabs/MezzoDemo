<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MezzoUpdateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::table('tutorials', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->index();
            $table->foreign('parent_id')->references('id')->on('tutorials')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table('tutorials', function (Blueprint $table) {
            $table->dropForeign('tutorials_parent_id_foreign');
            $table->dropColumn('parent_id');

            $table->dropForeign('tutorials_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
