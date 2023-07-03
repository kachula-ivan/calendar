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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('done')->default(false);
            $table->unsignedBigInteger('group');
            $table->unsignedBigInteger('color');
            $table->timestamps();
            $table->string('freq')->nullable();
            $table->integer('interval')->nullable();
            $table->string('byweekday')->nullable();
            $table->text('duration')->nullable();
            $table->dateTime('dtstart')->nullable();
            $table->dateTime('until')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id')->nullable();

            $table->index('user_id', 'event_user_idx');

            $table->foreign('user_id', 'event_user_fk')->on('users')->references('id');
            $table->foreign('color', 'event_color_fk')->on('colors')->references('id');
            $table->foreign('group', 'event_group_fk')->on('groups')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
