<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Appearance Settings
            [
                'key' => 'site_name',
                'value' => 'PORTAL GG',
                'type' => 'text',
                'group' => 'appearance',
                'label' => 'Nama Website',
                'description' => 'Nama website yang ditampilkan di sidebar dan browser',
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Logo Website',
                'description' => 'Logo yang ditampilkan di sidebar (opsional, jika kosong akan menggunakan icon default)',
            ],
            [
                'key' => 'site_icon',
                'value' => 'bi bi-lightning-charge-fill',
                'type' => 'text',
                'group' => 'appearance',
                'label' => 'Icon Default',
                'description' => 'Bootstrap Icons class untuk icon default jika tidak ada logo',
            ],

            // Footer Settings
            [
                'key' => 'footer_copyright',
                'value' => '© 2026 PORTAL GG. All rights reserved.',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Copyright Footer',
                'description' => 'Text copyright yang ditampilkan di footer',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
