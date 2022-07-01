<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionActionPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('option_action_permission')->insert(
            [
                [
                    'title'=>'List',
                    'code'=>'index',
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ],
                [
                    'title'=>'Add',
                    'code'=>'add',
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ],
                [
                    'title'=>'Edit',
                    'code'=>'edit',
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ],
                [
                    'title'=>'Delete',
                    'code'=>'delete',
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]
            ]
        );
    }
}
