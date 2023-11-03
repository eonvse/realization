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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('initiator_id');
            $table->string('name');
            $table->text('content');
            $table->unsignedBigInteger('zni');
            $table->date('dateZni');
            $table->unsignedBigInteger('doi')->nullable();
            $table->date('dateDoi')->nullable();
            $table->boolean('isDone')->default(0);
            $table->date('dateDone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clusters');
    }
};
