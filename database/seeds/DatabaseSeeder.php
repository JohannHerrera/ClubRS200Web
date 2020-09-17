<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Inicia llenado de tablas");

        $this->command->info("Insertando Roles...");
        DB::table('roles')->insert(array('description' => 'SIN ASIGNAR', 'isadmin' => false));
        DB::table('roles')->insert(array('description' => 'WEB MASTER', 'isadmin' => true));
        DB::table('roles')->insert(array('description' => 'LIDERES', 'isadmin' => true));
        DB::table('roles')->insert(array('description' => 'CONVENIOS', 'isadmin' => false));
        DB::table('roles')->insert(array('description' => 'PILOTOS', 'isadmin' => false));
        $this->command->info("OK");

        $this->command->info("Insertando Identificación...");
        DB::table('identificationtypes')->insert(array('description' => 'CC-CÉDULA CIUDADANÍA'));
        DB::table('identificationtypes')->insert(array('description' => 'CE-CÉDULA EXTRANJERÍA'));
        DB::table('identificationtypes')->insert(array('description' => 'NIT-NÚNERO IDENTIFICACIÓN TRIBUTARIA'));
        DB::table('identificationtypes')->insert(array('description' => 'PA-PASAPORTE'));
        DB::table('identificationtypes')->insert(array('description' => 'PEP-REGISTRO ESPECIAL DE PERMANENCIA'));
        DB::table('identificationtypes')->insert(array('description' => 'OTROS'));
        $this->command->info("OK");

        $this->command->info("Insertando Grupo Sanguineos...");
        DB::table('bloodgroups')->insert(array('description' => 'A+'));
        DB::table('bloodgroups')->insert(array('description' => 'B+'));
        DB::table('bloodgroups')->insert(array('description' => 'AB+'));
        DB::table('bloodgroups')->insert(array('description' => 'O+'));
        DB::table('bloodgroups')->insert(array('description' => 'A-'));
        DB::table('bloodgroups')->insert(array('description' => 'B-'));
        DB::table('bloodgroups')->insert(array('description' => 'AB-'));
        DB::table('bloodgroups')->insert(array('description' => 'O-'));
        $this->command->info("OK");

        $this->command->info("Insetando User...");
        DB::table('users')->insert(array(
            'rol_id' => 2,
            'identificationtype_id' => 6,
            'identification' => '99999999',
            'name' => 'host',
            'surname' => 'portal',
            'nick' => 'host',
            'email' => 'host@clubrs200.com',
            'defaultmotorbike' => 'XXX999',
            'password' => Hash::make('P@ssw0rd2020'),
            'image' => 'default.png',
            'bloodgroup_id' => null,
            'mobilenumber' => '',
            'emergencycontactname' => '',
            'emergencycontactnumber' => '',
            'isorgandonor' => false,
            'birthday' => null,
            'creationuser' => 'Registro Portal',
            'modificationuser' => 'Registro Portal',
            'isactive' => true));

        $this->command->info("OK");

        $this->command->info("Finaliza llenado de tablas");
    }
}
