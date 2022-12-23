<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Finance\Interfaces\Model\FinanceAttributeInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_attributes', function (Blueprint $table) {
            $table->id();
            $table->string(FinanceAttributeInterface::FINANCE_ATTRIBUTE_CODE)->unique();
            $table->string(FinanceAttributeInterface::FINANCE_ATTRIBUTE_TYPE, 10);
            $table->string(FinanceAttributeInterface::FINANCE_ATTRIBUTE_VALUE);
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
        Schema::dropIfExists('finance_attributes');
    }
};
