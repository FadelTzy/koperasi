<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'kelas.view',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'kelas.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'kelas.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'kelas.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'matkul.view',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'matkul.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'matkul.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'matkul.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'ruang.view',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'ruang.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'ruang.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'ruang.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'monitoring.view',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'monitoring.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'monitoring.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'monitoring.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'monitoring.cetak',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'user.view',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'user.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'user.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'user.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'user.sinkron',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'periode.add',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'periode.edit',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'periode.delete',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'periode.view',
            'guard_name' => 'web'
        ]);
    }
}
