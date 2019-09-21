<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarFieldToAccessMUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Access_m_User', function (Blueprint $table) {
            $table->string('avatar')
                ->nullable()
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Access_m_User', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
}
