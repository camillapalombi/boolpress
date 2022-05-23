<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')
                ->nullable()
                ->after('user_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('SET NULL')
                // ->onDelete('CASCADE')
                // ->onDelete('SET DEFAULT')
                ;
        });
        //Schema::disableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // TODO: farlo funzionare senza il dropColumn
            $table->dropColumn('category_id');
        });
    }
}
