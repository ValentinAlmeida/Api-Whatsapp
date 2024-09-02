<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->string('queue');
                $table->text('payload');
                $table->smallInteger('attempts');
                $table->smallInteger('reserved')->nullable();
                $table->integer('reserved_at')->nullable();
                $table->integer('available_at');
                $table->integer('created_at');
                
                $table->index(['queue', 'reserved', 'reserved_at'], 'idx_jobs_queue_reserved_reserved_at');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
