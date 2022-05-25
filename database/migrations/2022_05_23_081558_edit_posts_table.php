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
                ->default(1)
                ->after('user_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('SET NULL')
                // ->onDelete('CASCADE') //TODO: far funzionare questa qui
                // ->onDelete('SET DEFAULT') // pare che non funzioni per colpa dell'innoDB
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
