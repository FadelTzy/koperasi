<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 =  Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $role2 =  Role::create([
            'name' => 'mahasiswa',
            'guard_name' => 'web'
        ]);
        $role3 =  Role::create([
            'name' => 'dosen',
            'guard_name' => 'web'
        ]);
        $role4 =  Role::create([
            'name' => 'pimpinan',
            'guard_name' => 'web'
        ]);
        $role1->givePermissionTo(['kelas.view', 'kelas.add', 'kelas.edit', 'kelas.delete', 'matkul.view', 'matkul.add', 'matkul.edit', 'matkul.delete', 'ruang.view', 'ruang.add', 'ruang.edit', 'ruang.delete', 'monitoring.view', 'monitoring.add', 'monitoring.edit', 'monitoring.delete', 'monitoring.cetak', 'user.view', 'user.add', 'user.edit', 'user.delete', 'user.sinkron']);
    }
}
