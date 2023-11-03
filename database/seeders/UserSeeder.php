<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $super_admin = User::create([
//            "name" => 'مدير عام',
//            "email" => 'super_admin@app.com',
//            "password" => bcrypt('123'),
//        ]);
//        $super_admin->attachRole('superadministrator');
//
//        $admin = User::create([
//            "name" => 'مدير',
//            "email" => 'admin@app.com',
//            "password" => bcrypt('123'),
//        ]);
//
//        $admin->attachRole('administrator');
//        $employee = User::create([
//            "name" => 'موظف',
//            "email" => 'employee@app.com',
//            "password" => bcrypt('123'),
//        ]);
//        $admin->attachRole('user');

          Permission::create(
            [
            'name' => 'branches-create',
            'display_name' => 'Create branch', // optional
            'description' => 'create branch', // optional
           ]);

          Permission::create( [
                'name' => 'branches-read',
                'display_name' => 'show branch', // optional
                'description' => 'show branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'branches-update',
                'display_name' => 'update branch', // optional
                'description' => 'update branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'branches-delete',
                'display_name' => 'delete branch', // optional
                'description' => 'delete branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'sports-create',
                'display_name' => 'Create sports', // optional
                'description' => 'create sports', // optional
            ]);
          Permission::create(
            [
                'name' => 'sports-read',
                'display_name' => 'read branch', // optional
                'description' => 'read branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'sports-update',
                'display_name' => 'update branch', // optional
                'description' => 'update branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'sports-delete',
                'display_name' => 'delete branch', // optional
                'description' => 'delete branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'levels-create',
                'display_name' => 'Create branch', // optional
                'description' => 'create branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'levels-update',
                'display_name' => 'update branch', // optional
                'description' => 'update branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'levels-read',
                'display_name' => 'read branch', // optional
                'description' => 'read branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'levels-delete',
                'display_name' => 'delete branch', // optional
                'description' => 'delete branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'price-list-create',
                'display_name' => 'Create branch', // optional
                'description' => 'create branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'price-list-read',
                'display_name' => 'read branch', // optional
                'description' => 'read branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'price-list-update',
                'display_name' => 'update branch', // optional
                'description' => 'update branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'price-list-delete',
                'display_name' => 'delete branch', // optional
                'description' => 'delete branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'package-create',
                'display_name' => 'Create branch', // optional
                'description' => 'create branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'package-read',
                'display_name' => 'read branch', // optional
                'description' => 'read branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'package-update',
                'display_name' => 'update branch', // optional
                'description' => 'update branch', // optional
            ]);
          Permission::create(
            [
                'name' => 'package-delete',
                'display_name' => 'delete branch', // optional
                'description' => 'delete branch', // optional
            ]
        );

        Permission::create(
            [
                'name' => 'contracts-create',
                'display_name' => 'Create contracts', // optional
                'description' => 'create contracts', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-read',
                'display_name' => 'read contracts', // optional
                'description' => 'read contracts', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-update',
                'display_name' => 'update contracts', // optional
                'description' => 'update contracts', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-delete',
                'display_name' => 'delete contracts', // optional
                'description' => 'delete contracts', // optional
            ]
        );

        Permission::create(
            [
                'name' => 'contracts-partners-create',
                'display_name' => 'Create contracts-partners', // optional
                'description' => 'create contracts-partners', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-partners-read',
                'display_name' => 'read contracts-partners', // optional
                'description' => 'read contracts-partners', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-partners-update',
                'display_name' => 'update contracts-partners', // optional
                'description' => 'update contracts-partners', // optional
            ]);
        Permission::create(
            [
                'name' => 'contracts-partners-delete',
                'display_name' => 'delete contracts-partners', // optional
                'description' => 'delete contracts-partners', // optional
            ]
        );

        Permission::create(
            [
                'name' => 'players-create',
                'display_name' => 'Create players', // optional
                'description' => 'create players', // optional
            ]);
        Permission::create(
            [
                'name' => 'players-read',
                'display_name' => 'read players', // optional
                'description' => 'read players', // optional
            ]);
        Permission::create(
            [
                'name' => 'players-update',
                'display_name' => 'update players', // optional
                'description' => 'update players', // optional
            ]);
        Permission::create(
            [
                'name' => 'players-delete',
                'display_name' => 'delete players', // optional
                'description' => 'delete players', // optional
            ]
        );

        Permission::create(
            [
                'name' => 'activity-create',
                'display_name' => 'Create activity', // optional
                'description' => 'create activity', // optional
            ]);
        Permission::create(
            [
                'name' => 'activity-read',
                'display_name' => 'read activity', // optional
                'description' => 'read activity', // optional
            ]);
        Permission::create(
            [
                'name' => 'activity-update',
                'display_name' => 'update activity', // optional
                'description' => 'update activity', // optional
            ]);
        Permission::create(
            [
                'name' => 'activity-delete',
                'display_name' => 'delete activity', // optional
                'description' => 'delete activity', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'Incoming-receipts-create',
                'display_name' => 'Create Incoming-receipts', // optional
                'description' => 'create Incoming-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Incoming-receipts-read',
                'display_name' => 'read Incoming-receipts', // optional
                'description' => 'read Incoming-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Incoming-receipts-update',
                'display_name' => 'update Incoming-receipts', // optional
                'description' => 'update Incoming-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Incoming-receipts-delete',
                'display_name' => 'delete Incoming-receipts', // optional
                'description' => 'delete Incoming-receipts', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'Exchange-receipts-create',
                'display_name' => 'Create Exchange-receipts', // optional
                'description' => 'create Exchange-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Exchange-receipts-read',
                'display_name' => 'read Exchange-receipts', // optional
                'description' => 'read Exchange-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Exchange-receipts-update',
                'display_name' => 'update Exchange-receipts', // optional
                'description' => 'update Exchange-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'Exchange-receipts-delete',
                'display_name' => 'delete Exchange-receipts', // optional
                'description' => 'delete Exchange-receipts', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'type-receipts-create',
                'display_name' => 'Create type-receipts', // optional
                'description' => 'create type-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'type-receipts-read',
                'display_name' => 'read type-receipts', // optional
                'description' => 'read type-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'type-receipts-update',
                'display_name' => 'update type-receipts', // optional
                'description' => 'update type-receipts', // optional
            ]);
        Permission::create(
            [
                'name' => 'type-receipts-delete',
                'display_name' => 'delete type-receipts', // optional
                'description' => 'delete type-receipts', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'custody-create',
                'display_name' => ' create custody ', // optional
                'description' => ' create custody ', // optional
            ]);
        Permission::create(
            [
                'name' => 'custody-read',
                'display_name' => ' read custody ', // optional
                'description' => ' read custody ', // optional
            ]);
        Permission::create(
            [
                'name' => 'custody-update',
                'display_name' => ' update custody', // optional
                'description' => 'update custody', // optional
            ]);
        Permission::create(
            [
                'name' => 'custody-delete',
                'display_name' => 'delete custody', // optional
                'description' => 'delete custody', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'settlements-create',
                'display_name' => 'create settlements', // optional
                'description' => 'create settlements', // optional
            ]);
        Permission::create(
            [
                'name' => 'settlements-read',
                'display_name' => 'read settlements', // optional
                'description' => 'read settlements', // optional
            ]);
        Permission::create(
            [
                'name' => 'settlements-update',
                'display_name' => 'update settlements', // optional
                'description' => 'update settlements', // optional
            ]);
        Permission::create(
            [
                'name' => 'settlements-delete',
                'display_name' => 'delete settlements', // optional
                'description' => 'delete settlements', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'deductions-create',
                'display_name' => 'create deductions', // optional
                'description' => 'create deductions', // optional
            ]);
        Permission::create(
            [
                'name' => 'deductions-read',
                'display_name' => 'read deductions', // optional
                'description' => 'read deductions', // optional
            ]);
        Permission::create(
            [
                'name' => 'deductions-update',
                'display_name' => 'update deductions', // optional
                'description' => 'update deductions', // optional
            ]);
        Permission::create(
            [
                'name' => 'deductions-delete',
                'display_name' => 'delete deductions', // optional
                'description' => 'delete deductions', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'Attendance-players-create',
                'display_name' => 'create Attendance-players', // optional
                'description' => 'create Attendance-players', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-players-read',
                'display_name' => 'read Attendance-players', // optional
                'description' => 'read Attendance-players', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-players-update',
                'display_name' => 'update Attendance-players', // optional
                'description' => 'update Attendance-players', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-players-delete',
                'display_name' => 'delete Attendance-players', // optional
                'description' => 'delete Attendance-players', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'Attendance-trainers-create',
                'display_name' => 'create Attendance-trainers', // optional
                'description' => 'create Attendance-trainers', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-trainers-read',
                'display_name' => 'read Attendance-trainers', // optional
                'description' => 'read Attendance-trainers', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-trainers-update',
                'display_name' => 'update Attendance-trainers', // optional
                'description' => 'update Attendance-trainers', // optional
            ]);
        Permission::create(
            [
                'name' => 'Attendance-trainers-delete',
                'display_name' => 'delete Attendance-trainers', // optional
                'description' => 'delete Attendance-trainers', // optional
            ]
        );

        Permission::create(
            [
                'name' => 'stadiums-create',
                'display_name' => 'create stadiums', // optional
                'description' => 'create stadiums', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-read',
                'display_name' => 'read stadiums', // optional
                'description' => 'read stadiums', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-update',
                'display_name' => 'update stadiums', // optional
                'description' => 'update stadiums', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-delete',
                'display_name' => 'delete stadiums', // optional
                'description' => 'delete stadiums', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'stadiums-rent-create',
                'display_name' => 'create stadiums-rent', // optional
                'description' => 'create stadiums-rent', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-rent-read',
                'display_name' => 'read stadiums-rent', // optional
                'description' => 'read stadiums-rent', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-rent-update',
                'display_name' => 'update stadiums-rent', // optional
                'description' => 'update stadiums-rent', // optional
            ]);
        Permission::create(
            [
                'name' => 'stadiums-rent-delete',
                'display_name' => 'delete stadiums-rent', // optional
                'description' => 'delete stadiums-rent', // optional
            ]
        );
        Permission::create(
            [
                'name' => 'tournament-create',
                'display_name' => 'create tournament', // optional
                'description' => 'create tournament', // optional
            ]);
        Permission::create(
            [
                'name' => 'tournament-read',
                'display_name' => 'read tournament', // optional
                'description' => 'read tournament', // optional
            ]);
        Permission::create(
            [
                'name' => 'tournament-update',
                'display_name' => 'update tournament', // optional
                'description' => 'update tournament', // optional
            ]);
        Permission::create(
            [
                'name' => 'tournament-delete',
                'display_name' => 'delete tournament', // optional
                'description' => 'delete tournament', // optional
            ]
        );
    }
}
