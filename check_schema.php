<?php
$columns = \Illuminate\Support\Facades\DB::select('SELECT COLUMN_NAME, IS_NULLABLE, COLUMN_TYPE FROM information_schema.columns WHERE table_schema = ? AND table_name = ?', [env('DB_DATABASE'), 'bookings']);
foreach ($columns as $col) {
    echo "{$col->COLUMN_NAME} | {$col->COLUMN_TYPE} | Nullable: {$col->IS_NULLABLE}\n";
}
