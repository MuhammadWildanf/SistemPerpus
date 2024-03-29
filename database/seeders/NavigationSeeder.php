<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $konfigurasi = Navigation::create([
        "name" => 'Konfigurasi',
        "url"  => 'konfigurasi',
        "icon" => 'ti-settings',
        'main_menu' => null,
        ]);
            $konfigurasi->subMenus()->create([
                "name" => 'Roles',
                "url"  => 'konfigurasi/roles',
                "icon" => '',
            ]);
            $konfigurasi->subMenus()->create([
            "name" => 'Permissions',
            "url"  => 'konfigurasi/permissions',
            "icon" => '',
            ]);
            $konfigurasi->subMenus()->create([
                "name" => 'Harga',
                "url"  => 'konfigurasi/prices',
                "icon" => '',
                ]);

       $transaksi =  Navigation::create([
        "name" => 'Layanan',
        "url"  => 'layanan',
        "icon" => 'ti-book',
        'main_menu' => null,
        ]);
            $transaksi->subMenus()->create([
            "name" => 'Plagiarism',
            "url"  => 'layanan/plagiarism',
            "icon" => '',
            ]);
            $transaksi->subMenus()->create([
            "name" => 'Plagiarism',
            "url"  => 'layanan/pengajuan-plagiarism',
            "icon" => '',
            ]);
            $transaksi->subMenus()->create([
            "name" => 'Jilid Laporan',
            "url"  => 'layanan/jilid',
            "icon" => '',
            ]);
            $transaksi->subMenus()->create([
                "name" => 'Jilid Laporan',
                "url"  => 'layanan/pengajuan-jilid',
                "icon" => '',
                ]);
            $transaksi->subMenus()->create([
            "name" => 'Berkas Ta',
            "url"  => 'layanan/berkas',
            "icon" => '',
            ]);
            $transaksi->subMenus()->create([
            "name" => 'Berkas Ta',
            "url"  => 'layanan/file',
            "icon" => '',
            ]);
    }
}
