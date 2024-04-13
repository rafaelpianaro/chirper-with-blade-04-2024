<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToChirpsTable extends Migration
{
    public function up()
    {
        Schema::table('chirps', function (Blueprint $table) {
            $table->softDeletes(); // Isso adiciona a coluna `deleted_at`
        });
    }

    public function down()
    {
        Schema::table('chirps', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Isso remove a coluna `deleted_at`
        });
    }
}
