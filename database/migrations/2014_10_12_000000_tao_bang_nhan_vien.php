<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NHAN_VIEN', function (Blueprint $table) {
            $table->bigIncrements('ID_NV');
            $table->string('TEN_NV');
            $table->string('ID_LOAI');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('SDT')
            $table->rememberToken();
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
        Schema::dropIfExists('NHAN_VIEN');
    }
}
