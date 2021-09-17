<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cu = Auth::user();
        $roles = DB::table('roles')
                ->where('status', 'Active')
                ->get();

        return view('roles.index', compact('roles', 'cu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cu = Auth::user();
        return view('roles.create', compact('cu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $permission = array();

        if(isset($data['userview'])){
            $permission['userview'] = $data['userview'];
        }
        if(isset($data['usercreate'])){
            $permission['usercreate'] = $data['usercreate'];
        }
        if(isset($data['useredit'])){
            $permission['useredit'] = $data['useredit'];
        }
        if(isset($data['userdelete'])){
            $permission['userdelete'] = $data['userdelete'];
        }
        if(isset($data['roleview'])){
            $permission['roleview'] = $data['roleview'];
        }
        if(isset($data['rolecreate'])){
            $permission['rolecreate'] = $data['rolecreate'];
        }
        if(isset($data['roleedit'])){
            $permission['roleedit'] = $data['roleedit'];
        }
        if(isset($data['roledelete'])){
            $permission['roledelete'] = $data['roledelete'];
        }
        if(isset($data['deptview'])){
            $permission['deptview'] = $data['deptview'];
        }
        if(isset($data['deptcreate'])){
            $permission['deptcreate'] = $data['deptcreate'];
        }
        if(isset($data['deptedit'])){
            $permission['deptedit'] = $data['deptedit'];
        }
        if(isset($data['deptdelete'])){
            $permission['deptdelete'] = $data['deptdelete'];
        }
        if(isset($data['storeview'])){
            $permission['storeview'] = $data['storeview'];
        }
        if(isset($data['storecreate'])){
            $permission['storecreate'] = $data['storecreate'];
        }
        if(isset($data['storeedit'])){
            $permission['storeedit'] = $data['storeedit'];
        }
        if(isset($data['storedelete'])){
            $permission['storedelete'] = $data['storedelete'];
        }
        if(isset($data['categoryview'])){
            $permission['categoryview'] = $data['categoryview'];
        }
        if(isset($data['categorycreate'])){
            $permission['categorycreate'] = $data['categorycreate'];
        }
        if(isset($data['categoryedit'])){
            $permission['categoryedit'] = $data['categoryedit'];
        }
        if(isset($data['categorydelete'])){
            $permission['categorydelete'] = $data['categorydelete'];
        }
        if(isset($data['materialview'])){
            $permission['materialview'] = $data['materialview'];
        }
        if(isset($data['materialadd'])){
            $permission['materialadd'] = $data['materialadd'];
        }
        if(isset($data['materialedit'])){
            $permission['materialedit'] = $data['materialedit'];
        }
        if(isset($data['materialdelete'])){
            $permission['materialdelete'] = $data['materialdelete'];
        }
        if(isset($data['materialapprove'])){
            $permission['materialapprove'] = $data['materialapprove'];
        }
        if(isset($data['locationview'])){
            $permission['locationview'] = $data['locationview'];
        }
        if(isset($data['locationadd'])){
            $permission['locationadd'] = $data['locationadd'];
        }
        if(isset($data['locationedit'])){
            $permission['locationedit'] = $data['locationedit'];
        }
        if(isset($data['locationdelete'])){
            $permission['locationdelete'] = $data['locationdelete'];
        }
        if(isset($data['locationapprove'])){
            $permission['locationapprove'] = $data['locationapprove'];
        }
        if(isset($data['registerview'])){
            $permission['registerview'] = $data['registerview'];
        }
        if(isset($data['registeradd'])){
            $permission['registeradd'] = $data['registeradd'];
        }
        if(isset($data['registeredit'])){
            $permission['registeredit'] = $data['registeredit'];
        }
        if(isset($data['registerdelete'])){
            $permission['registerdelete'] = $data['registerdelete'];
        }
        if(isset($data['registerapprove'])){
            $permission['registerapprove'] = $data['registerapprove'];
        }
        if(isset($data['settingsview'])){
            $permission['settingsview'] = $data['settingsview'];
        }
        if(isset($data['settingsmanage'])){
            $permission['settingsmanage'] = $data['settingsmanage'];
        }
        if(isset($data['primaryapprover'])){
            $permission['primaryapprover'] = $data['primaryapprover'];
        }
        if(isset($data['debit'])){
            $permission['debit'] = $data['debit'];
        }
        if(isset($data['credit'])){
            $permission['credit'] = $data['credit'];
        }
        if(isset($data['download'])){
            $permission['download'] = $data['download'];
        }

        if(empty($permission)){
            return redirect()->back()->with('role_empty', 'Minimum one permission is required !');
        }else{
            $validate_data = [
                'name'          => $data['name'],
                'permissions'   => json_encode($permission),
                'added_by'      => Auth::id(),
                'status'        => 'Active',
            ];

            $validate_role = [
                'name'          => 'required|unique:roles',
                'permissions'   => 'required',
                'added_by'      => 'required',
            ];
            $message = [
                'name.required'         => 'Role name is required !',
                'name.unique'           => 'Role name is already exists or trushed !',
                'permissions.required'  => 'Minimum one permission is required !',
            ];
            Validator::make($validate_data, $validate_role, $message)->validate();

            Role::create($validate_data);

            return redirect()->back()->with('success', 'Role has been created !');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cu = Auth::user();
        $role = Role::find($id);
        if(!isset($role)){
            abort(404);
        }
        $permissions = json_decode($role->permissions, true);
        if($role->status == 'Deleted'){
            abort(420);
        }else{
            return view('roles.edit', compact('cu', 'role', 'permissions'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $cu = Auth::user();
        $permission = array();

        if(isset($data['userview'])){
            $permission['userview'] = $data['userview'];
        }
        if(isset($data['usercreate'])){
            $permission['usercreate'] = $data['usercreate'];
        }
        if(isset($data['useredit'])){
            $permission['useredit'] = $data['useredit'];
        }
        if(isset($data['userdelete'])){
            $permission['userdelete'] = $data['userdelete'];
        }
        if(isset($data['roleview'])){
            $permission['roleview'] = $data['roleview'];
        }
        if(isset($data['rolecreate'])){
            $permission['rolecreate'] = $data['rolecreate'];
        }
        if(isset($data['roleedit'])){
            $permission['roleedit'] = $data['roleedit'];
        }
        if(isset($data['roledelete'])){
            $permission['roledelete'] = $data['roledelete'];
        }
        if(isset($data['deptview'])){
            $permission['deptview'] = $data['deptview'];
        }
        if(isset($data['deptcreate'])){
            $permission['deptcreate'] = $data['deptcreate'];
        }
        if(isset($data['deptedit'])){
            $permission['deptedit'] = $data['deptedit'];
        }
        if(isset($data['deptdelete'])){
            $permission['deptdelete'] = $data['deptdelete'];
        }
        if(isset($data['storeview'])){
            $permission['storeview'] = $data['storeview'];
        }
        if(isset($data['storecreate'])){
            $permission['storecreate'] = $data['storecreate'];
        }
        if(isset($data['storeedit'])){
            $permission['storeedit'] = $data['storeedit'];
        }
        if(isset($data['storedelete'])){
            $permission['storedelete'] = $data['storedelete'];
        }
        if(isset($data['categoryview'])){
            $permission['categoryview'] = $data['categoryview'];
        }
        if(isset($data['categorycreate'])){
            $permission['categorycreate'] = $data['categorycreate'];
        }
        if(isset($data['categoryedit'])){
            $permission['categoryedit'] = $data['categoryedit'];
        }
        if(isset($data['categorydelete'])){
            $permission['categorydelete'] = $data['categorydelete'];
        }
        if(isset($data['materialview'])){
            $permission['materialview'] = $data['materialview'];
        }
        if(isset($data['materialadd'])){
            $permission['materialadd'] = $data['materialadd'];
        }
        if(isset($data['materialedit'])){
            $permission['materialedit'] = $data['materialedit'];
        }
        if(isset($data['materialdelete'])){
            $permission['materialdelete'] = $data['materialdelete'];
        }
        if(isset($data['materialapprove'])){
            $permission['materialapprove'] = $data['materialapprove'];
        }
        if(isset($data['locationview'])){
            $permission['locationview'] = $data['locationview'];
        }
        if(isset($data['locationadd'])){
            $permission['locationadd'] = $data['locationadd'];
        }
        if(isset($data['locationedit'])){
            $permission['locationedit'] = $data['locationedit'];
        }
        if(isset($data['locationdelete'])){
            $permission['locationdelete'] = $data['locationdelete'];
        }
        if(isset($data['locationapprove'])){
            $permission['locationapprove'] = $data['locationapprove'];
        }        
        if(isset($data['registerview'])){
            $permission['registerview'] = $data['registerview'];
        }
        if(isset($data['registeradd'])){
            $permission['registeradd'] = $data['registeradd'];
        }
        if(isset($data['registeredit'])){
            $permission['registeredit'] = $data['registeredit'];
        }
        if(isset($data['registerdelete'])){
            $permission['registerdelete'] = $data['registerdelete'];
        }
        if(isset($data['registerapprove'])){
            $permission['registerapprove'] = $data['registerapprove'];
        }
        if(isset($data['settingsview'])){
            $permission['settingsview'] = $data['settingsview'];
        }
        if(isset($data['settingsmanage'])){
            $permission['settingsmanage'] = $data['settingsmanage'];
        }
        if(isset($data['primaryapprover'])){
            $permission['primaryapprover'] = $data['primaryapprover'];
        }
        if(isset($data['debit'])){
            $permission['debit'] = $data['debit'];
        }
        if(isset($data['credit'])){
            $permission['credit'] = $data['credit'];
        }
        if(isset($data['download'])){
            $permission['download'] = $data['download'];
        }

        if(empty($permission)){
            return redirect()->back()->with('role_empty', 'Minimum one permission is required !');
        }else{
            $validate_data = [
                'name'          => $data['name'],
                'permissions'   => json_encode($permission),
                'updated_by'    => $cu->id,
                'status'        => 'Active',
            ];

            $validate_role = [
                'name'          => 'required|unique:roles,name,'.$id,
                'permissions'   => 'required',
            ];
            $message = [
                'name.required'         => 'Role name is required !',
                'name.unique'           => 'Role name is already exists !',
                'permissions.required'  => 'Minimum one permission is required !',
            ];
            Validator::make($validate_data, $validate_role, $message)->validate();

            Role::where('id', $id)->update($validate_data);

            return redirect()->back()->with('success', 'Role has been updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cu = Auth::user();
        User::where('id', $id)->update(['status'    => 'Deleted', 'delete_by'  => $cu->id]);
        Role::where('id', $id)->update(['status'    => 'Deleted', 'delete_by'  => $cu->id]);
        return redirect()->back()->with('success', 'Role has been deleted !');
    }

    public function trushed(){
        $roles = trushed_roles();

        return view('roles.trushed', compact('roles'));
    }

    public function reactive( $id ){
        $role = Role::find($id);
        $cu = Auth::user();

        if( empty($role) || $role == NULL ){
            abort(404);
        }else{
            $reactive_data = [
                'status'    => 'Active',
                'added_by'  => $cu->id,
            ];

            Role::where( 'id', $id )->update( $reactive_data );
            return redirect()->back()->with('success', 'Role has been re-activated !');
        }
    }

}
