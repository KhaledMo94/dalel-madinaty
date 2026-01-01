<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // All permissions used in the sidebar
        $array = [
            'categories',      // Used in sidebar line 27
            'listings',        // Used in sidebar line 51
            'users',           // Used in sidebar line 86
            'cities',          // Used in sidebar line 104
            'areas',           // Used in sidebar line 122
            'banners',         // Used in sidebar line 140
            'options',         // Used in sidebar line 159
            'amenities',       // Used in sidebar line 179
            'notifications',   // Used in sidebar line 198
            'offers',          // Used in sidebar line 218
            'commenters',      // Used in sidebar line 228
        ];

        foreach ($array as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
