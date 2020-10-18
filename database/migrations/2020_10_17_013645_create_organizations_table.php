<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('organizations',
            function(Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->foreign('parent_id')
                      ->references('id')
                      ->on('organizations')
                      ->onDelete('cascade');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('organizations');
    }
}
