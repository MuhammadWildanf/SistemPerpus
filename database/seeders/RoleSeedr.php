<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Psy\Exception\ThrowUpException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Throwable;

class RoleSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();

        try{

            $admin = User::create(array_merge([
                'email' => 'admin@stiki.ac.id',
                'name'  => 'admin'
            ], $default_user_value));

            $perpustakaan = User::create(array_merge([
                'email' => 'perpustakaan@stiki.ac.id',
                'name'  => 'perpustakaan'
            ], $default_user_value));
    
            $mahasiswa = User::create(array_merge([
                'email' => 'mahasiswa@stiki.ac.id',
                'name'  => 'mahasiswa'
            ], $default_user_value));
    
            $prodi = User::create(array_merge([
                'email' => 'prodi@stiki.ac.id',
                'name'  => 'prodi'
            ], $default_user_value));
    
            $koorLab = User::create(array_merge([
                'email' => 'koorLab@stiki.ac.id',
                'name'  => 'koorLab'
            ], $default_user_value));
    
            $role_perpustakaan = Role::create(['name' => 'perpustakaan']);
            $role_mahasiswa = Role::create(['name' => 'mahasiswa']);
            $role_prodi = Role::create(['name' => 'prodi']);
            $role_koorLab = Role::create(['name' => 'koorLab']);
            $role_admin = Role::create(['name' => 'admin']);

            //konfigurasi role
            $permission = Permission::create(['name' =>'read konfigurasi']);
            $permission = Permission::create(['name' =>'read konfigurasi/roles']);
            $permission = Permission::create(['name' =>'create konfigurasi/roles']);
            $permission = Permission::create(['name' =>'update konfigurasi/roles']);
            $permission = Permission::create(['name' =>'delete konfigurasi/roles']);
            
            //konfigurasi permission
            $permission = Permission::create(['name' =>'read konfigurasi/permissions']);
            $permission = Permission::create(['name' =>'create konfigurasi/permissions']);
            $permission = Permission::create(['name' =>'update konfigurasi/permissions']);
            $permission = Permission::create(['name' =>'delete konfigurasi/permissions']);

            //layanan Plagiarism
            $permission = Permission::create(['name' =>'read layanan']);
            $permission = Permission::create(['name' =>'read layanan/plagiarism']);
            $permission = Permission::create(['name' =>'create layanan/plagiarism']);
            $permission = Permission::create(['name' =>'update layanan/plagiarism']);
            $permission = Permission::create(['name' =>'delete layanan/plagiarism']);

            //layanan BerkasTA
            $permission = Permission::create(['name' =>'read layanan/berkasTa']);
            $permission = Permission::create(['name' =>'create layanan/berkasTa']);
            $permission = Permission::create(['name' =>'update layanan/berkasTa']);
            $permission = Permission::create(['name' =>'delete layanan/berkasTa']);

            //layanan jilid laporan
            $permission = Permission::create(['name' =>'read layanan/jilidLaporan']);
            $permission = Permission::create(['name' =>'create layanan/jilidLaporan']);
            $permission = Permission::create(['name' =>'update layanan/jilidLaporan']);
            $permission = Permission::create(['name' =>'delete layanan/jilidLaporan']);


            //give permission roles
            $role_admin->givePermissionTo(['read konfigurasi/roles','read konfigurasi']);
            $role_admin->givePermissionTo('create konfigurasi/roles');
            $role_admin->givePermissionTo('update konfigurasi/roles');
            $role_admin->givePermissionTo('delete konfigurasi/roles');

            //give permission permission
            $role_admin->givePermissionTo('read konfigurasi/permissions');
            $role_admin->givePermissionTo('create konfigurasi/permissions');
            $role_admin->givePermissionTo('update konfigurasi/permissions');
            $role_admin->givePermissionTo('delete konfigurasi/permissions');


             //give permission layanan plagiarism

             $role_admin->givePermissionTo(['read layanan/plagiarism','read layanan']);
             $role_admin->givePermissionTo('create layanan/plagiarism');
             $role_admin->givePermissionTo('update layanan/plagiarism');
             $role_admin->givePermissionTo('delete layanan/plagiarism');

             //give permission layanan berkasTa

             $role_admin->givePermissionTo('read layanan/berkasTa');
             $role_admin->givePermissionTo('create layanan/berkasTa');
             $role_admin->givePermissionTo('update layanan/berkasTa');
             $role_admin->givePermissionTo('delete layanan/berkasTa');

             //give permission layanan Jilid

             $role_admin->givePermissionTo('read layanan/jilidLaporan');
             $role_admin->givePermissionTo('create layanan/jilidLaporan');
             $role_admin->givePermissionTo('update layanan/jilidLaporan');
             $role_admin->givePermissionTo('delete layanan/jilidLaporan');
    
             

            //role
            $perpustakaan->assignRole('perpustakaan');
            $mahasiswa->assignRole('mahasiswa');
            $prodi->assignRole('prodi');
            $koorLab->assignRole('koorLab');
            $admin->assignRole('admin');

            DB::commit();
        }catch(Throwable $th){
            DB::rollBack();
        }



    }
}