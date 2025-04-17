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
        Schema::create('electoral_committee_members', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('electoral_committee_id');
            $table->foreign('electoral_committee_id')->references('id')->on('electoral_committees')->onDelete('cascade');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('electoral_committee_positions')->onDelete('cascade');           
            $table->string('surname');
            $table->string('firstname');
            $table->string('othernames')->nullable();
            $table->unsignedBigInteger('college_id')->nullable();
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('level')->nullable();
            $table->string('photo')->nullable();
            $table->string('filesize')->nullable();
            $table->string('filetype')->nullable();
            $table->string('slogan')->nullable();
            $table->string('bio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_committee_members');
    }
};
