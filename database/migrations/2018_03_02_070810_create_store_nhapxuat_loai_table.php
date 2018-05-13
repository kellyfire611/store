<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreNhapxuatLoaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_nhapxuat_loai', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ma_loai_nhapxuat', 191)->unique()->comment('Mã loại nhập xuất');;
            $table->string('ten_loai_nhapxuat', 191)->comment('Tên loại nhập xuất');
            $table->boolean('la_nhap')->comment('Là nhập');
            $table->boolean('la_noibo')->comment('Là nội bộ');
            $table->boolean('la_hoantra')->comment('Là hoàn trả');
            
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
        Schema::dropIfExists('store_nhapxuat_loai');
    }
}
