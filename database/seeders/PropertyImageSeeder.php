<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyImageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('property_images')->delete();

        DB::table('property_images')->insert([
            ['id' => 1, 'properti_id' => '0198a628-2a21-71be-9b4f-8e6968d69c2f', 'path' => 'data-properti/01K24M4TXY710E1853N5T3PZ4Q.jpg', 'is_primary' => 1, 'created_at' => '2025-08-05 14:38:29', 'updated_at' => '2025-08-05 14:38:29'],
            ['id' => 2, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9FW5756C514X9T3A97.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 3, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9J283592F017X8F55S.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 4, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9K2CZE3480B7V08S8T.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 5, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9N961E62Y46W854E1Y.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 6, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9PH8G93892015HCA6Z.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 7, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9R15E06041D3H794XQ.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 8, 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9ST5N742111X585Q8T.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => 9, 'properti_id' => '0198e919-61da-7e1e-afb9-f8c56cc75037', 'path' => 'data-properti/01K27E58GTVK6332159828236Q.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:16:15', 'updated_at' => '2025-08-06 14:16:15'],
            ['id' => 10, 'properti_id' => '0198e919-61da-7e1e-afb9-f8c56cc75037', 'path' => 'data-properti/01K27E58GWR9W7789315A5994Q.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:16:15', 'updated_at' => '2025-08-06 14:16:15'],
            ['id' => 11, 'properti_id' => '0198e919-61da-7e1e-afb9-f8c56cc75037', 'path' => 'data-properti/01K27E58GX39T6687440X5812B.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:16:15', 'updated_at' => '2025-08-06 14:16:15'],
            ['id' => 12, 'properti_id' => '0198e919-61da-7e1e-afb9-f8c56cc75037', 'path' => 'data-properti/01K27E58GYV0R57545E01088T7.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:16:15', 'updated_at' => '2025-08-06 14:16:15'],
            ['id' => 13, 'properti_id' => '0198e919-61da-7e1e-afb9-f8c56cc75037', 'path' => 'data-properti/01K27E58HZWYG76121D5H434M1.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:16:15', 'updated_at' => '2025-08-06 14:16:15'],
            ['id' => 14, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R7X5402506456E9652P.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 15, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R7YPDW1531388Z0240P.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 16, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R7ZY6X4629486C32152.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 17, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R8095V6488347V25350.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 18, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R8264N4642438V7132H.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 19, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R83J3S3458519E7587E.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 20, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R84C9K4187313P4700Z.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 21, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R85P9N6342111E5587K.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 22, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R8610Y4546452F5290J.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 23, 'properti_id' => '0198e923-3dbd-7206-8c75-dc38257007f9', 'path' => 'data-properti/01K27E9R8665M5756382W3549K.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:18:41', 'updated_at' => '2025-08-06 14:18:41'],
            ['id' => 24, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTE1900139589N0121R.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 25, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTHG124508492X2281S.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 26, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTJCZT1332468W5750X.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 27, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTKV338166548D2930H.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 28, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTMSV82502621W9940T.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 29, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTN41H1708170T9731M.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 30, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTP6R85435940H3238V.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 31, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTQX4X0541574T1589C.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 32, 'properti_id' => '0198e92a-e8d1-7290-b97c-9b88fe3dc4e8', 'path' => 'data-properti/01K27ECZTRPPC5359740Z9613R.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:20:25', 'updated_at' => '2025-08-06 14:20:25'],
            ['id' => 33, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGV10E9425263W5781P.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20'],
            ['id' => 34, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGW39D9002951Y0652Y.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20'],
            ['id' => 35, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGXT8W7734185Z6053H.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20'],
            ['id' => 36, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGXM4Q6524583V9542H.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20'],
            ['id' => 37, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGY59G0958117Z2402Y.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20'],
            ['id' => 38, 'properti_id' => '0198e932-a39c-76e3-ae09-2458eb9b7d59', 'path' => 'data-properti/01K27EGJGZJFW1781669Y2698J.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:22:20', 'updated_at' => '2025-08-06 14:22:20']
        ]);
    }
}
