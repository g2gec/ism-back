<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateUserDefault extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'avatar' => '',
                'canHire' => false,
                'country' => 'EC',
                'email' => 'demoadmin@devias.io',
                'apellido' => 'Contreras',
                'membresia_id' => '1',
                'membresia_numero' => '1',
                'isPublic' => true,
                'name' => 'Juan',
                'password' => 'Password123',
                'phone' => '+40 777666555',
                'isActive' => false,
                'lastActivity' => Carbon::now()->toDateTimeString(),
                'role' => 'admin',
                'state' => 'Quito',
                'domicilio' => 'Mi casa',
                'documento' => '1759444571',
                'fecha_expiracion_documento' => '2021-05-05',
                'costo_membresia' => NULL,
                'tier' => 'ADMINISTRADOR'
            ],
            [
                'avatar' => '',
                'canHire' => false,
                'country' => 'EC',
                'email' => 'demovendedor@devias.io',
                'apellido' => 'Smith',
                'membresia_id' => '1',
                'membresia_numero' => '2',
                'isPublic' => true,
                'name' => 'Katarina',
                'password' => 'Password123',
                'phone' => '+40 777666555',
                'isActive' => false,
                'lastActivity' => Carbon::now()->toDateTimeString(),
                'role' => 'vendedor',
                'state' => 'Quito',
                'domicilio' => 'Mi casa',
                'documento' => '1759444571',
                'fecha_expiracion_documento' => '2021-05-05',
                'tipo_vendedor' => 'INTERNO',
                'costo_membresia' => NULL,
                'tier' => 'VENDEDOR'
            ],
            [
                'avatar' => '',
                'canHire' => false,
                'country' => 'EC',
                'email' => 'demoasociado@devias.io',
                'apellido' => 'Monzalve',
                'membresia_id' => '1',
                'membresia_numero' => '3',
                'isPublic' => true,
                'name' => 'Carlos',
                'password' => 'Password123',
                'phone' => '+40 777666555',
                'isActive' => false,
                'lastActivity' => Carbon::now()->toDateTimeString(),
                'role' => 'asociado',
                'state' => 'Quito',
                'domicilio' => 'Mi casa',
                'documento' => '1759444571',
                'fecha_expiracion_documento' => '2021-05-05',
                'costo_membresia' => 12,
                'tier' => 'ASOCIADO'
            ]
        ];

        foreach ($users as $key => $value) {
            DB::table('users')->insert([
                'name' => $value['name'],
                'email' => $value['email'],
                'apellido' => $value['apellido'],
                'membresia_id' => $value['membresia_id'],
                'membresia_numero' => $value['membresia_numero'],
                'email_verified_at' => now(),
                'password' => Hash::make(($value['password'])),
                'avatar' => $value['avatar'],
                'canHire' => $value['canHire'],
                'country' => $value['country'],
                'isPublic' => $value['isPublic'],
                'phone' => $value['phone'],
                'username' => $value['name'].".".$value['apellido'],
                'isActive' => $value['isActive'],
                'lastActivity' => $value['lastActivity'],
                'role' => $value['role'],
                'state' => $value['state'],
                'tier' => $value['tier'],
                'domicilio' => $value['domicilio'],
                'documento' => $value['documento'],
                'fecha_expiracion_documento' => $value['fecha_expiracion_documento'],
                'costo_membresia' => $value['costo_membresia'],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
