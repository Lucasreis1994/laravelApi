<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // [
        //     'originCurrency',
        //     'targetCurrency',
        //     'conversionValue',
        //     'paymentMethod',
        //     'valueOriginCurrency',
        //     'valueTargetCurrency',
        //     'payTax',
        //     'conversionTax',
        //     'valueConversionDiscountingTax'
        // ]
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->string('originCurrency');
            $table->string('targetCurrency');
            $table->decimal('conversionValue',15,2);
            $table->integer('paymentMethod')->comment('1=boleto 2=cartao');
            $table->decimal('valueOriginCurrency',15,2);
            $table->decimal('valueTargetCurrency',15,2);
            $table->decimal('payTax',15,2);
            $table->decimal('conversionTax',15,2);
            $table->decimal('valueConversionDiscountingTax',15,2);
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
        Schema::dropIfExists('conversions');
    }
};
