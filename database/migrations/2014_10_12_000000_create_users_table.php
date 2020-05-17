<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('type')->default('patient');
            $table->string('clinic')->nullable();
            $table->string('shift')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('creditcard_number')->nullable();
            $table->date('creditcard_expire')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        //insert Admin account into users table
        DB::table('users')->insert(
            array(
                array(
                    'name'=>'Doctor1',
                    'email' => 'doctor1@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 1',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor2',
                    'email' => 'doctor2@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 2',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor3',
                    'email' => 'doctor3@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 3',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor4',
                    'email' => 'doctor4@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 4',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor5',
                    'email' => 'doctor5@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 5',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor6',
                    'email' => 'doctor6@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 6',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor7',
                    'email' => 'doctor7@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 7',
                    'shift'=>'00:00 - 08:00'
                ),
                array(
                    'name'=>'Doctor8',
                    'email' => 'doctor8@gmail.com',
                    'password'=>bcrypt('123123123'),
                    'type' => 'doctor',
                    'clinic' => 'Clinic 8',
                    'shift'=>'00:00 - 08:00'
                ),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
