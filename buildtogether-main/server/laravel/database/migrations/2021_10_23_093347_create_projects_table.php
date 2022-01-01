<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->mediumText('summary');
            $table->enum('ptype', ['longTerm', 'hackathon']);
            $table->enum('category', ['technology', 'marketing', 'education', 'finance', 'business']);
            $table->double('totalFund')->default(0);
            $table->double('achievedFund')->default(0);
            $table->date('startDate')->default(Carbon::today()->toDateString())->nullable();;
            $table->date('endDate')->default(NULL)->nullable();
            $table->binary('photo')->nullable();
            $table->timestamps();
            $table->unsignedInteger('owner');
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}