<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name', 100);
            $table->string('address', 100)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('url', 100)->nullable();
            $table->Date('started_date')->nullable();
            $table->Date('expiry_date')->nullable();
            $table->integer('no_of_users')->default(5); //no of users allowed for this tenant
            $table->enum('status', ['Pending payment', 'Active', 'Disabled'])->default('Active');
            $table->foreignId('plan_id')->unsigned()->nullable()->constrained()->onDelete('set null');
            $table->foreignId('country_id')->default(211);
            $table->string('settings')->nullable();
            $table->string('features')->nullable();
            $table->boolean('isPaid')->default(false)->nullable();
            $table->integer('invoice_id')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}