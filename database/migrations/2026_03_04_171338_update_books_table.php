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
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')
                ->nullable()
                ->after('id');
            $table->dropColumn('author');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        chema::table('books', function (Blueprint $table) {
            $table->dropColumn('author_id');
            $table->string('author')->after('name');
        });
    }
};
