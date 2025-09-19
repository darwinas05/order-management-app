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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //Datos para el delivery
            $table->string('customer_name');
            $table->text('address');
            $table->string('phone');
            $table->text('note')->nullable();

            //Tipo de orden: para llevar, en el local, delivery
            $table->enum('order_type',
            ['dine-in','delivery','takeaway'])->default('dine-in');
            $table->integer('table_number')->nullable();

            //Diferentes estados por los que pasa una orden
             $table->enum('status',
            ['pending', 'preparing','delivering','completed','cancelled'])->default('pending');

            //Relacion del empleados que ha tomado la orden
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

           $table->decimal('total_price', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
