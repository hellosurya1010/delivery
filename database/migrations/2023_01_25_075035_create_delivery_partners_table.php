<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_partners', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->foreignId('user_id');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_live')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->string('driving_license_number')->nullable();
            $table->string('driving_license_image')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_partners');
    }
}
