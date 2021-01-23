<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments("id")->unsigned();
            $table->string("serial_number")->unique();
            $table->string("date");
            $table->integer("down_payment");
            $table->integer("amount");
            $table->string("branch");
            $table->unsignedInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
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
        Schema::dropIfExists('invoices');
    }
}
