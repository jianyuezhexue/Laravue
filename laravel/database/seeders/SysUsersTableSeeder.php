<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysUsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_users')->delete();

        DB::table('sys_users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'created_at' => '2020-10-09 21:46:11',
                'updated_at' => '2020-10-09 21:46:11',
                'deleted_at' => NULL,
                'uuid' => '81e98dea-3289-47c8-8d90-9dbc48310d8b',
                'username' => 'admin',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'nick_name' => '超级管理员',
                'header_img' => 'http://qmplusimg.henrongyi.top/1571627762timg.jpg',
                'authority_id' => '888',
            ),
            1 =>
            array(
                'id' => 2,
                'created_at' => '2020-10-09 21:46:11',
                'updated_at' => '2020-10-09 21:46:11',
                'deleted_at' => NULL,
                'uuid' => '9715b6bf-041a-47cd-9481-d5e3a7b2abc9',
                'username' => 'a303176530',
                'password' => '3ec063004a6f31642261936a379fde3d',
                'nick_name' => 'QMPlusUser',
                'header_img' => 'http://qmplusimg.henrongyi.top/1572075907logo.png',
                'authority_id' => '9528',
            ),
        ));
    }
}
