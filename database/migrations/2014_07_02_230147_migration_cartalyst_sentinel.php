<?php

/**
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    2.0.15
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2017, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrationCartalystSentinel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('code');
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('permissions')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('slug');
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['user_id', 'role_id']);
        });

        Schema::create('throttle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->default("");
            $table->string('email')->unique();
            $table->string('identification')->unique()->nullable();
            $table->string('phone')->unique()->default('');
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->boolean('gender')->nullable();
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('tutors', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('job')->nullable();
            $table->string('workplace')->nullable();
            $table->boolean('status')->default(0);

            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('access_level')->default(1);

            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('school')->nullable();

            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->engine = 'InnoDB';
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->engine = 'InnoDB';
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('fee')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unique(array('user_id', 'area_id', 'subject_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('roles');
        Schema::drop('role_users');
        Schema::drop('throttle');
        Schema::drop('tutors');
        Schema::drop('admins');
        Schema::drop('students');
        Schema::drop('courses');
        Schema::drop('users');
        Schema::drop('areas');
        Schema::drop('subjects');
    }
}
