<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions = [
            'userview'          => 'on',
            'usercreate'        => 'on',
            'useredit'          => 'on',
            'userdelete'        => 'on',
            'roleview'          => 'on',
            'rolecreate'        => 'on',
            'roleedit'          => 'on',
            'roledelete'        => 'on',
            'deptview'          => 'on',
            'deptcreate'        => 'on',
            'deptedit'          => 'on',
            'deptdelete'        => 'on',
            'storeview'         => 'on',
            'storecreate'       => 'on',
            'storeedit'         => 'on',
            'storedelete'       => 'on',
            'categoryview'      => 'on',
            'categorycreate'    => 'on',
            'categoryedit'      => 'on',
            'categorydelete'    => 'on',
            'materialedit'      => 'on',
            'materialdelete'    => 'on',
            'materialview'      => 'on',
            'locationview'      => 'on',
            'locationedit'      => 'on',
            'locationdelete'    => 'on',
            'registerview'      => 'on',
            'registeredit'      => 'on',
            'registerdelete'    => 'on',
            'settingsmanage'    => 'on',
            'download'          => 'on',
        ];
        
        DB::table('roles')->insert([
            'name'              => 'Super Admin',
            'permissions'       => json_encode($permissions),
            'added_by'          => 1,
            'created_at'        => date("Y-m-d H:i:s"),
            'updated_at'        => date("Y-m-d H:i:s"),
            'status'            => 'Active',
        ]);
    }
}
