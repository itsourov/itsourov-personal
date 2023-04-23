<?php

use App\Enums\DownloadLinkType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('download_items', function (Blueprint $table) {
            $table->id();

            $table->integer('download_itemable_id')->unsigned();
            $table->string('download_itemable_type');
            $table->string('title');
            $table->enum('type', DownloadLinkType::toArray())->default(DownloadLinkType::directLink);
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_items');
    }
};