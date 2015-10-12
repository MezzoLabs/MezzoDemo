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
            $table->foreign('parent')->references('id')->on('tutorials')->onDelete('cascade')->nullable();
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
            $table->dropForeign('tutorials_parent_foreign');
            $table->dropColumn('parent');
        });
    }
}
