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
        Schema::create('jobs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('title');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('job_nature');
            $table->integer('vacancy');
            $table->string('location');
            $table->string('position');
            $table->text('description');
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
