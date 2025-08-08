<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('designation');
            $table->string('department');
            $table->date('joining_date');
            $table->string('employment_type');
            $table->string('salary_range');
            $table->string('bonus_eligibility')->nullable();
            $table->text('benefits')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->text('address');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('resume')->nullable();
            $table->string('id_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
