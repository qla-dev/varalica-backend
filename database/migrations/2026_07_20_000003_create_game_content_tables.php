<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impostor_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('impostor_words', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('impostor_category_id')->constrained()->cascadeOnDelete();
            $table->string('word');
            $table->string('hint');
            $table->timestamps();
            $table->unique(['impostor_category_id', 'word']);
        });

        Schema::create('truth_dare_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('truth_dare_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('truth_dare_category_id')->constrained()->cascadeOnDelete();
            $table->string('type', 10);
            $table->text('question');
            $table->timestamps();
        });

        Schema::create('rather_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('rather_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('rather_category_id')->constrained()->cascadeOnDelete();
            $table->text('option_a');
            $table->text('option_b');
            $table->timestamps();
        });

        Schema::create('dva_srca_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('dva_srca_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('dva_srca_category_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->timestamps();
        });

        Schema::create('guess_word_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('guess_word_words', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('guess_word_category_id')->constrained()->cascadeOnDelete();
            $table->string('word');
            $table->string('hint');
            $table->timestamps();
            $table->unique(['guess_word_category_id', 'word']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guess_word_words');
        Schema::dropIfExists('guess_word_categories');
        Schema::dropIfExists('dva_srca_questions');
        Schema::dropIfExists('dva_srca_categories');
        Schema::dropIfExists('rather_questions');
        Schema::dropIfExists('rather_categories');
        Schema::dropIfExists('truth_dare_questions');
        Schema::dropIfExists('truth_dare_categories');
        Schema::dropIfExists('impostor_words');
        Schema::dropIfExists('impostor_categories');
    }
};
