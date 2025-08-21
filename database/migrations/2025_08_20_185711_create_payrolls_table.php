
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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id('payroll_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('month');
            $table->integer('year');
            $table->decimal('gross_salary',10,2);
            $table->decimal('total_deductions',10,2);
            $table->decimal('bonuses',10,2);
            $table->decimal('net_salary',10,2);
            $table->dateTime('generated_at');
            $table->timestamps();

            //foreign key
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};


