<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date_created');
            $table->foreignId('user_id')->constrained();
            $table->double('total', 10, 2);
            $table->foreignId('status_id')->constrained();
            $table->foreignId('point_of_sales_id')->constrained('point_of_sales');
            $table->foreignId('client_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
