<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
        use SoftDeletes;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id');
            $table->string('image')->nullable();
            $table->enum('status',['delivered','in_process','completed','rejected']);
            $table->longText('description');
                        $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_statuses');
    }
};
