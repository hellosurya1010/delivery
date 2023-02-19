<?php

use App\Models\Shipment;
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
            $table->string('shipment_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('delivery_partner_id')->nullable();
            $table->timestamp('to_delivery_at')->nullable();
            $table->float('price')->nullable();
            $table->float('distance')->nullable();
            $table->string('status')->default(Shipment::$statusOrderPlaced);

            $table->string('pickup_lat')->nullable();
            $table->string('pickup_lon')->nullable();
            $table->string('pickup_place_id')->nullable();
            $table->string('pickup_place_name')->nullable();

            $table->string('dropin_lat')->nullable();
            $table->string('dropin_lon')->nullable();
            $table->string('dropin_place_id')->nullable();
            $table->string('dropin_place_name')->nullable();

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
