<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSoketoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_soketoan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ma_soketoan')->unique()->comment('Mã sổ kế toán');
            $table->dateTime('ngay_batdau')->comment('Ngày bắt đầu Sổ kế toán');
            $table->dateTime('ngay_ketthuc')->nullable()->comment('Ngày kết thúc Sổ kế toán');
            $table->datetime('ngay_khoaso')->nullable()->comment('Ngày khóa Sổ kế toán');
            
            $table->smallInteger('company_id')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('store_soketoan');
    }
}
