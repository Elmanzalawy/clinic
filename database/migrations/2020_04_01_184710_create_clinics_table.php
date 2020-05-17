<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('price');
            $table->timestamps();
        });

        DB::table('clinics')->insert(
            array(
                array(
                    'name'=>'Clinic 1',
                    'type'=>'Dental Clinic',
                    'price'=>100
                ),
                array(
                    'name'=>'Clinic 2',
                    'type'=>'Skin Care Clinic',
                    'price'=>120
                ),
                array(
                    'name'=>'Clinic 3',
                    'type'=>'Physiotherapy Clinic',
                    'price'=>150
                ),
                array(
                    'name'=>'Clinic 4',
                    'type'=>'Vaccination Clinic',
                    'price'=>80
                ),
                array(
                    'name'=>'Clinic 5',
                    'type'=>'Rehabilitation Clinic',
                    'price'=>110
                ),
                array(
                    'name'=>'Clinic 6',
                    'type'=>'Blood Bank',
                    'price'=>50
                ),
                array(
                    'name'=>'Clinic 7',
                    'type'=>'Dialysis Clinic',
                    'price'=>140
                ),
                array(
                    'name'=>'Clinic 8',
                    'type'=>'Orthopedic Clinic',
                    'price'=>180
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
        Schema::dropIfExists('clinics');
    }
}
