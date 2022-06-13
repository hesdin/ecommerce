<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // EC/YYYYMMDD/ORDER/UNIQ_NUM
            $table->foreignId('customer_id');
            $table->text('alamat_kirim');
            $table->string('no_hp');
            $table->enum('status', ['Pending', 'Proses', 'Dikirim', 'Selesai', 'Batal']);
            $table->string('total_harga');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
