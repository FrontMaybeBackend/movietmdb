<?php

use App\Models\Serie;
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
        Schema::create('translation_series', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Serie::class)->constrained();
            $table->text('trans_pl_title')->nullable();
            $table->text('trans_pl_overview')->nullable();
            $table->text('trans_de_title')->nullable();
            $table->text('trans_de_overview')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_series');
    }
};
