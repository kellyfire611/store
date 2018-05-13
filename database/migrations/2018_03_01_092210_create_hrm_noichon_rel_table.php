<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrmNoichonRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_noichon_rel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->unsignedInteger('quocgia_id')->comment('Quốc gia');
            $table->unsignedInteger('tinhthanh_id')->comment('Tỉnh thành');
            $table->unsignedInteger('quanhuyen_id')->comment('Quận huyện');
            $table->unsignedInteger('xaphuong_id')->comment('Xã phường');
            $table->foreign('quocgia_id')->references('id')->on('hrm_quocgia');
            $table->foreign('tinhthanh_id')->references('id')->on('hrm_tinhthanh');
            $table->foreign('quanhuyen_id')->references('id')->on('hrm_quanhuyen');
            $table->foreign('xaphuong_id')->references('id')->on('hrm_xaphuong');
            $table->unique(['quocgia_id', 'tinhthanh_id', 'quanhuyen_id', 'xaphuong_id'], 'hrm_noichon_rel_unique');
            
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
        Schema::dropIfExists('hrm_noichon_rel');
    }
}
