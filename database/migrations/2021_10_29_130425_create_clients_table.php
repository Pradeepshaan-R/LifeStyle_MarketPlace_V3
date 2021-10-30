<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Individual', 'Company'])->default('Individual');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('company_name', 191)->nullable();
            $table->string('company_email', 60)->nullable();
            $table->string('company_website', 191)->nullable();
            $table->string('company_address', 191)->nullable();
            $table->string('company_city', 60)->nullable();
            $table->string('company_pv_no', 15)->nullable();
            $table->string('company_phone', 15)->nullable();
            $table->enum('company_legal_type', ['Sole', 'Pvt', 'Ltd', 'Plc', 'Gov'])->default('Pvt');
            $table->foreignId('country_id')->default(211);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}