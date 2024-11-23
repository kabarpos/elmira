<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique(); // INV/2024/03/001
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_percentage', 5, 2)->default(11.0); // PPN Indonesia
            $table->decimal('tax_amount', 12, 2);
            $table->decimal('total', 12, 2);
            $table->text('notes')->nullable();
            $table->string('status')->default('unpaid'); // unpaid, partial, paid, cancelled
            $table->json('payment_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
