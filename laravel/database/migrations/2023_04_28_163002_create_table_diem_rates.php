<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('diem_rates', function (Blueprint $table) {
            $table->string('country_iso_code', 2)->primary();
            $table->integer('amount')->nullable(false);
            $table->string('currency', 4)->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diem_rates');
    }
};
