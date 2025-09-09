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
            $table->id('employee_id'); // primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('gender');
            $table->text('address');
            $table->string('phone');
            $table->string('designation');

            // Foreign keys
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('role_id');

            $table->date('date_joined');
            $table->string('status')->default('active'); // e.g. active = full time, inactive = part time
            $table->integer('available_leave')->default(15);
            $table->string('id_proof')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');

            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
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
