<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->unique(); // PRJ-2024-001
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('due_date');
            $table->decimal('total_price', 12, 2);
            $table->integer('revision_limit')->default(2);
            $table->integer('revision_count')->default(0);
            $table->string('status')->default('draft'); // draft, ongoing, review, completed, cancelled
            $table->text('notes')->nullable();
            $table->json('requirements')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
