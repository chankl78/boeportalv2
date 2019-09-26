<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderFieldToMembersMSsaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Members_m_SSA', function (Blueprint $table) {
            $table->enum('gender', ['M', 'F'])->after('nationality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Members_m_SSA', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
}
