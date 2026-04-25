<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Cek apakah kolom midtrans_response belum ada
            if (!Schema::hasColumn('transactions', 'midtrans_response')) {
                $table->json('midtrans_response')->nullable()->after('payment_type');
            }
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('midtrans_response');
        });
    }
};