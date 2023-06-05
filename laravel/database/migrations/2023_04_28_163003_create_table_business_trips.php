<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('business_trips', function (Blueprint $table) {
            $table->id();
            $table->uuid('employee_uuid');
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->string('country_iso_code')->nullable(false);
            $table->integer('diem_rate_amount')->nullable(false);
            $table->string('diem_rate_currency', 4)->nullable(false);
            $table->timestamps();

            $table->foreign('employee_uuid')
                ->on('employees')
                ->references('uuid')
                ->cascadeOnDelete()
            ;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_trips');
    }
};
