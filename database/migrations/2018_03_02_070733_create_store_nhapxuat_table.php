<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreNhapxuatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_nhapxuat', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ma_nhapxuat', 191)->unique()->comment('Mã nhập xuất');
            $table->string('ten_nhapxuat', 191)->comment('Tên nhập xuất');
            $table->string('lydo_nhapxuat', 191)->nullable()->comment('Lý do nhập xuất');
            
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
        Schema::dropIfExists('store_nhapxuat');
    }
}
