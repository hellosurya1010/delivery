<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
           $table->increments('id')->index();
            // $table->unsignedInteger('customer_id');
            // $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            // $table->unsignedInteger('delivery_partner_id');
            // $table->foreign('delivery_partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('delivery_partner_id')->nullable();
            $table->timestamp('to_delivery_at')->nullable();
            $table->float('price')->nullable();
            $table->float('distance')->nullable();
            $table->string('pick_lat')->nullable();
            $table->string('pick_lon')->nullable();
            $table->string('delivery_lat')->nullable();
            $table->string('delivery_lon')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
