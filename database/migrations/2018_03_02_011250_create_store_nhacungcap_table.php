<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreNhacungcapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_nhacungcap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ma_nhacungcap')->unique()->comment('Mã nhà cung cấp');
            $table->string('ten_nhacungcap')->comment('Tên nhà cung cấp');
            $table->string('diachi_nhacungcap')->comment('Địa chỉ nhà cung cấp');
            $table->string('sodienthoai_nhacungcap')->comment('Số điện thoại nhà cung cấp');
            
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
        Schema::dropIfExists('store_nhacungcap');
    }
}
