<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        $tables = [
            'impostor_categories',
            'impostor_words',
            'truth_dare_categories',
            'truth_dare_questions',
            'rather_categories',
            'rather_questions',
            'dva_srca_categories',
            'dva_srca_questions',
            'guess_word_categories',
            'guess_word_words',
        ];

        foreach ($tables as $table) {
            DB::statement("ALTER TABLE `{$table}` ENGINE=InnoDB");
        }

        Schema::table('impostor_words', function (Blueprint $table) {
            $table->foreign('impostor_category_id')->references('id')->on('impostor_categories')->cascadeOnDelete();
        });
        Schema::table('truth_dare_questions', function (Blueprint $table) {
            $table->foreign('truth_dare_category_id')->references('id')->on('truth_dare_categories')->cascadeOnDelete();
        });
        Schema::table('rather_questions', function (Blueprint $table) {
            $table->foreign('rather_category_id')->references('id')->on('rather_categories')->cascadeOnDelete();
        });
        Schema::table('dva_srca_questions', function (Blueprint $table) {
            $table->foreign('dva_srca_category_id')->references('id')->on('dva_srca_categories')->cascadeOnDelete();
        });
        Schema::table('guess_word_words', function (Blueprint $table) {
            $table->foreign('guess_word_category_id')->references('id')->on('guess_word_categories')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        Schema::table('impostor_words', fn (Blueprint $table) => $table->dropForeign(['impostor_category_id']));
        Schema::table('truth_dare_questions', fn (Blueprint $table) => $table->dropForeign(['truth_dare_category_id']));
        Schema::table('rather_questions', fn (Blueprint $table) => $table->dropForeign(['rather_category_id']));
        Schema::table('dva_srca_questions', fn (Blueprint $table) => $table->dropForeign(['dva_srca_category_id']));
        Schema::table('guess_word_words', fn (Blueprint $table) => $table->dropForeign(['guess_word_category_id']));
    }
};
