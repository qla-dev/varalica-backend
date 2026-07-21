<?php

use App\Support\StarterFreeContent;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        StarterFreeContent::add();
    }

    public function down(): void
    {
        StarterFreeContent::remove();
    }
};
