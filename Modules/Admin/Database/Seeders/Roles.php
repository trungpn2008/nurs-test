<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'title'=>'Admin',
                'description'=>'Quyền mặc định admin',
                'prioritized'=>1,
                'non_delete'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        );
    }
}
