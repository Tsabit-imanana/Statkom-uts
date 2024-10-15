<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_first_major');
            $table->bigInteger('id_first_university');
            $table->bigInteger('id_second_major');
            $table->bigInteger('id_second_university');
            $table->bigInteger('id_user');
            $table->integer('score_eko');
            $table->integer('score_geo');
            $table->integer('score_kmb');
            $table->integer('score_kpu');
            $table->integer('score_kua');
            $table->integer('score_mat');
            $table->integer('score_ppu');
            $table->integer('score_sej');
            $table->integer('score_sos');
            $table->decimal('total', 20, 3);
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
