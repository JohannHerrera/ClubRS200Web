<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->boolean('isadmin')->unsigned()->default(false);
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('identificationtypes', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->default(1)->unsigned()->index();
            $table->integer('identificationtype_id')->unsigned()->nullable()->index();
            $table->string('identification',15)->nullable()->index();
            $table->string('name',200)->default('--');
            $table->string('surname',200)->default('--');
            $table->string('nick',100)->index();
            $table->string('email',250)->unique();
            $table->string('defaultmotorbike',15)->index();
            $table->string('password',400);
            $table->string('image',400)->default('default.png');

            $table->string('bloodgroup_id', 5)->nullable();
            $table->string('mobilenumber', 15)->default('--')->nullable();
            $table->string('emergencycontactname', 400)->default('--')->nullable();
            $table->string('emergencycontactnumber', 15)->default('--')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('isorgandonor')->unsigned()->default(false)->nullable();


            $table->boolean('isactive')->unsigned()->default(false);
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('identificationtype_id')->references('id')->on('identificationtypes');
            $table->foreign('bloodgroup_id')->references('id')->on('bloodgroups');
        });

        Schema::create('bloodgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->default('--')->nullable();
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('motorcyclemodels', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });


        Schema::create('cilindys', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id')->key();
            $table->string('description')->default('--');
            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();
        });

        Schema::create('motorcycles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('motorbike', 15)->default('--');

            $table->integer('brand_id')->unsigned()->index()->nullable();
            $table->integer('line_id')->unsigned()->index()->nullable();
            $table->integer('motorcyclemodel_id')->unsigned()->index()->nullable();
            $table->integer('cilindy_id')->unsigned()->index()->nullable();
            $table->integer('color_id')->unsigned()->index()->nullable();

            $table->date('dateexpirationsoat');
            $table->date('dateexpirationtecn');

            $table->string('creationuser')->default('--')->nullable();
            $table->string('modificationuser')->default('--')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->foreign('motorcyclemodel_id')->references('id')->on('motorcyclemodels');
            $table->foreign('cilindy_id')->references('id')->on('cilindys');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motorcycles');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('lines');
        Schema::dropIfExists('motorcyclemodels');
        Schema::dropIfExists('cilindys');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('pilots');
        Schema::dropIfExists('bloodgroups');
        Schema::dropIfExists('users');
        Schema::dropIfExists('identificationtypes');
        Schema::dropIfExists('roles');
    }
}
