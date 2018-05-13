<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreNhapxuatLoaiRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_nhapxuat_loai_rel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->unsignedInteger('nhapxuat_id')->comment('Nhập xuất');
            $table->unsignedInteger('nhapxuat_loai_id')->comment('Loại nhập xuất');
            $table->foreign('nhapxuat_id')->references('id')->on('store_nhapxuat');
            $table->foreign('nhapxuat_loai_id')->references('id')->on('store_nhapxuat_loai');
            $table->unique(['nhapxuat_id', 'nhapxuat_loai_id'], 'store_nhapxuat_loai_rel_unique');
            
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
        Schema::dropIfExists('store_nhapxuat_loai_rel');
    }
}
