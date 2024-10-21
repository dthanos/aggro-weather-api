<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ForecastStep;

class CreateForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->text('temperature')->nullable();
            $table->text('precipitation')->nullable();
            $table->text('datetime')->nullable();
            $table->enum('step', array_column(ForecastStep::cases(), 'name'))->nullable();
            $table->timestamps();

            // Remove entry in case location is removed
            $table->foreignId('location_id')->nullable()
                ->references('id')
                ->on('locations')
                ->cascadeOnDelete();
            // Set null in case remote api is removed
            $table->foreignId('remote_api_id')->nullable()
                ->references('id')
                ->on('remote_apis')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forecasts');
    }
}
