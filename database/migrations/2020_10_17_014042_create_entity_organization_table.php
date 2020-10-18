<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('entity_organization',
            function(Blueprint $table) {
                $table->id();
                $table->morphs('entity');
                $table->unsignedBigInteger('organization_id');
                $table->boolean('include_sub_org')->default(false);
                $table->foreign('organization_id')->references('id')->on('organizations')
                      ->onDelete('cascade');
                $table->timestamps();

                $table->unique(['entity_type', 'entity_id', 'organization_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('entity_organization');
    }
}
