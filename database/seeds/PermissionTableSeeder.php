<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空权限相关的数据表
        //将sql外键约束关闭
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Permission::truncate();
        Role::truncate();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');   //开启外键约束

        //创建初始的管理员用户
        $aa = User::create([
            'name' => 'ws',
            'email' => '1473949341@qq.com',
            'password' =>bcrypt('123456')

        ]);
       // $aa = User::find('users')->where('name', 'aa')->first();
       //$aa = User::where('name', '=', 'aa')->first();

        //创建初始的role(初始的角色设定)
        $admin = Role::create([
           'name' => 'admin',
            'display_name' => '管理员',
            'description' => 'super admin role'
        ]);

        //创建相应的初始权限
        $permissions= [
            [
               'name' => 'create_user',
                'display_name' => '创建用户',
            ],
            [
                'name' => 'edit_user',
                'display_name' => '编辑用户',
            ],
            [
                'name' => 'delete_user',
                'display_name' => '删除用户',
            ],
            [
                'name' => 'edit_role',
                'display_name' => '编辑角色',
            ],
            [
                'name' => 'delete_role',
                'display_name' => '删除角色',
            ]
        ];
        foreach($permissions as $permission)
        {
            $manage_user = Permission::create($permission);
            //给角色赋予权限
            $admin->attachPermission($manage_user);
        }

        //给用户赋予角色
        $aa->attachRole($admin);
    }
}
