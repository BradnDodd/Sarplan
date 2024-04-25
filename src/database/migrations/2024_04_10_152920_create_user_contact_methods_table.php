<?php

use App\Enums\User\UserContactMethodTypeEnum;
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
        Schema::create('user_contact_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('contact');
            $table->enum('type', array_column(UserContactMethodTypeEnum::cases(), 'value'));
            $table->boolean('primary_method_for_type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contact_methods');
    }
};
