<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('role_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        // Permissions
        $permissions = [
            [1, 'view_agen', 'web'],
            [2, 'view_any_agen', 'web'],
            [3, 'create_agen', 'web'],
            [4, 'update_agen', 'web'],
            [5, 'restore_agen', 'web'],
            [6, 'restore_any_agen', 'web'],
            [7, 'replicate_agen', 'web'],
            [8, 'reorder_agen', 'web'],
            [9, 'delete_agen', 'web'],
            [10, 'delete_any_agen', 'web'],
            [11, 'force_delete_agen', 'web'],
            [12, 'force_delete_any_agen', 'web'],
            [13, 'view_informasi', 'web'],
            [14, 'view_any_informasi', 'web'],
            [15, 'create_informasi', 'web'],
            [16, 'update_informasi', 'web'],
            [17, 'restore_informasi', 'web'],
            [18, 'restore_any_informasi', 'web'],
            [19, 'replicate_informasi', 'web'],
            [20, 'reorder_informasi', 'web'],
            [21, 'delete_informasi', 'web'],
            [22, 'delete_any_informasi', 'web'],
            [23, 'force_delete_informasi', 'web'],
            [24, 'force_delete_any_informasi', 'web'],
            [25, 'view_jenis::properti', 'web'],
            [26, 'view_any_jenis::properti', 'web'],
            [27, 'create_jenis::properti', 'web'],
            [28, 'update_jenis::properti', 'web'],
            [29, 'restore_jenis::properti', 'web'],
            [30, 'restore_any_jenis::properti', 'web'],
            [31, 'replicate_jenis::properti', 'web'],
            [32, 'reorder_jenis::properti', 'web'],
            [33, 'delete_jenis::properti', 'web'],
            [34, 'delete_any_jenis::properti', 'web'],
            [35, 'force_delete_jenis::properti', 'web'],
            [36, 'force_delete_any_jenis::properti', 'web'],
            [37, 'view_master::wilayah', 'web'],
            [38, 'view_any_master::wilayah', 'web'],
            [39, 'create_master::wilayah', 'web'],
            [40, 'update_master::wilayah', 'web'],
            [41, 'restore_master::wilayah', 'web'],
            [42, 'restore_any_master::wilayah', 'web'],
            [43, 'replicate_master::wilayah', 'web'],
            [44, 'reorder_master::wilayah', 'web'],
            [45, 'delete_master::wilayah', 'web'],
            [46, 'delete_any_master::wilayah', 'web'],
            [47, 'force_delete_master::wilayah', 'web'],
            [48, 'force_delete_any_master::wilayah', 'web'],
            [49, 'view_pelanggan', 'web'],
            [50, 'view_any_pelanggan', 'web'],
            [51, 'create_pelanggan', 'web'],
            [52, 'update_pelanggan', 'web'],
            [53, 'restore_pelanggan', 'web'],
            [54, 'restore_any_pelanggan', 'web'],
            [55, 'replicate_pelanggan', 'web'],
            [56, 'reorder_pelanggan', 'web'],
            [57, 'delete_pelanggan', 'web'],
            [58, 'delete_any_pelanggan', 'web'],
            [59, 'force_delete_pelanggan', 'web'],
            [60, 'force_delete_any_pelanggan', 'web'],
            [61, 'view_penjualan', 'web'],
            [62, 'view_any_penjualan', 'web'],
            [63, 'create_penjualan', 'web'],
            [64, 'update_penjualan', 'web'],
            [65, 'restore_penjualan', 'web'],
            [66, 'restore_any_penjualan', 'web'],
            [67, 'replicate_penjualan', 'web'],
            [68, 'reorder_penjualan', 'web'],
            [69, 'delete_penjualan', 'web'],
            [70, 'delete_any_penjualan', 'web'],
            [71, 'force_delete_penjualan', 'web'],
            [72, 'force_delete_any_penjualan', 'web'],
            [73, 'view_properti', 'web'],
            [74, 'view_any_properti', 'web'],
            [75, 'create_properti', 'web'],
            [76, 'update_properti', 'web'],
            [77, 'restore_properti', 'web'],
            [78, 'restore_any_properti', 'web'],
            [79, 'replicate_properti', 'web'],
            [80, 'reorder_properti', 'web'],
            [81, 'delete_properti', 'web'],
            [82, 'delete_any_properti', 'web'],
            [83, 'force_delete_properti', 'web'],
            [84, 'force_delete_any_properti', 'web'],
            [85, 'view_role', 'web'],
            [86, 'view_any_role', 'web'],
            [87, 'create_role', 'web'],
            [88, 'update_role', 'web'],
            [89, 'delete_role', 'web'],
            [90, 'delete_any_role', 'web'],
            [91, 'view_user', 'web'],
            [92, 'view_any_user', 'web'],
            [93, 'create_user', 'web'],
            [94, 'update_user', 'web'],
            [95, 'restore_user', 'web'],
            [96, 'restore_any_user', 'web'],
            [97, 'replicate_user', 'web'],
            [98, 'reorder_user', 'web'],
            [99, 'delete_user', 'web'],
            [100, 'delete_any_user', 'web'],
            [101, 'force_delete_user', 'web'],
            [102, 'force_delete_any_user', 'web'],
            [103, 'page_AboutUs', 'web'],
            [104, 'page_Contact', 'web'],
            [105, 'page_Dasbor', 'web'],
            [106, 'page_Settings', 'web'],
            [107, 'widget_CustomDashboardStats', 'web'],
            [108, 'widget_LatestProperti', 'web'],
            [109, 'widget_LatestUsers', 'web'],
            [110, 'widget_ActiveUsers', 'web'],
            [111, 'view_testimoni', 'web'],
            [112, 'create_testimoni', 'web'],
            [113, 'update_testimoni', 'web'],
            [114, 'view_announcement', 'web'],
            [115, 'view_any_announcement', 'web'],
            [116, 'create_announcement', 'web'],
            [117, 'update_announcement', 'web'],
            [118, 'restore_announcement', 'web'],
            [119, 'restore_any_announcement', 'web'],
            [120, 'replicate_announcement', 'web'],
            [121, 'reorder_announcement', 'web'],
            [122, 'delete_announcement', 'web'],
            [123, 'delete_any_announcement', 'web'],
            [124, 'force_delete_announcement', 'web'],
            [125, 'force_delete_any_announcement', 'web'],
            [126, 'view_s::k::privasi', 'web'],
            [127, 'view_any_s::k::privasi', 'web'],
            [128, 'create_s::k::privasi', 'web'],
            [129, 'update_s::k::privasi', 'web'],
            [130, 'restore_s::k::privasi', 'web'],
            [131, 'restore_any_s::k::privasi', 'web'],
            [132, 'replicate_s::k::privasi', 'web'],
            [133, 'reorder_s::k::privasi', 'web'],
            [134, 'delete_s::k::privasi', 'web'],
            [135, 'delete_any_s::k::privasi', 'web'],
            [136, 'force_delete_s::k::privasi', 'web'],
            [137, 'force_delete_any_s::k::privasi', 'web'],
            [138, 'view_slider', 'web'],
            [139, 'view_any_slider', 'web'],
            [140, 'create_slider', 'web'],
            [141, 'update_slider', 'web'],
            [142, 'restore_slider', 'web'],
            [143, 'restore_any_slider', 'web'],
            [144, 'replicate_slider', 'web'],
            [145, 'reorder_slider', 'web'],
            [146, 'delete_slider', 'web'],
            [147, 'delete_any_slider', 'web'],
            [148, 'force_delete_slider', 'web'],
            [149, 'force_delete_any_slider', 'web'],
            [150, 'view_any_testimoni', 'web'],
            [151, 'restore_testimoni', 'web'],
            [152, 'restore_any_testimoni', 'web']
        ];

        foreach ($permissions as $p) {
            DB::table('permissions')->insert([
                'id' => $p[0],
                'name' => $p[1],
                'guard_name' => $p[2],
                'created_at' => '2025-08-05 13:31:26',
                'updated_at' => '2025-08-05 13:31:26'
            ]);
        }

        // Roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'super_admin', 'guard_name' => 'web', 'created_at' => '2025-08-05 13:31:05', 'updated_at' => '2025-08-05 13:31:05'],
            ['id' => 2, 'name' => 'admin', 'guard_name' => 'web', 'created_at' => '2025-08-05 14:06:07', 'updated_at' => '2025-08-05 14:06:07']
        ]);

        // Role Has Permissions (Super Admin gets all)
        $rolePermissions = [];
        for ($i = 1; $i <= 152; $i++) {
            $rolePermissions[] = ['permission_id' => $i, 'role_id' => 1];
        }
        DB::table('role_has_permissions')->insert($rolePermissions);

        // Model Has Roles
        DB::table('model_has_roles')->insert([
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 1],
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 2],
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 3],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 4],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 6],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 7]
        ]);
    }
}
