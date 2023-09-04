<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use DB;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $datas = Permission::latest()->get();
        return view('admin.pages.permission.allpermission', compact('datas'));

    }

    public function addPermission()
    {
        return view('admin.pages.permission.addpermission');
    }

    public function storePermission(Request $request)
    {
        // dd($request->all());
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'admin',
            'group_name' => $request->group_name,
        ]);
        // dd($data);

        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all-permission')->with($notification);

    }

    public function editPermission($id)
    {
        $data = Permission::findOrFail($id);
        return view('admin.pages.permission.editpermission', compact('data'));
    }

    public function updatePermission(Request $request)
    {

        $id = $request->id;

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all-permission')->with($notification);

    }

    public function deletePermission($id)
    {

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }


    public function allRoles()
    {

        $datas = Role::all();
        return view('admin.pages.roles.allroles', compact('datas'));

    } // End Method


    public function addRoles()
    {
        return view('admin.pages.roles.addroles');
    } // End Method


    public function storeRoles(Request $request)
    {

        Role::create([
            'name' => $request->name,
            'guard_name' => 'admin',
        ]);

        $notification = array(
            'message' => 'Role Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all-roles')->with($notification);

    } // End Method


    public function editRoles($id)
    {

        $data = Role::findOrFail($id);
        return view('admin.pages.roles.editroles', compact('data'));

    } // End Method


    public function updateRoles(Request $request)
    {

        $id = $request->id;

        Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all-roles')->with($notification);

    } // End Method

    public function deleteRoles($id)
    {

        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }


    public function addRolesPermission()
    {

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('admin.pages.roles_in_permission.addrolespermission', compact('roles', 'permissions', 'permission_groups'));

    }

    public function rolePermisssionStore(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $item) {
            $data[] = [
                'role_id' => $request->role_id,
                'permission_id' => $item,
            ];
        }

        if (!empty($data)) {
            // Use an insert method that allows inserting multiple records at once
            DB::table('role_has_permissions')->insert($data);
        }

        $notification = [
            'message' => 'Role Permissions Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all-roles-permission')->with($notification);


    }

    public function allRolesPermission()
    {

        $roles = Role::all();
        return view('admin.pages.roles_in_permission.allrolespermission', compact('roles'));

    }


    public function editRolesPermission($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('admin.pages.roles_in_permission.editrolespermission', compact('role', 'permissions', 'permission_groups'));

    }


    public function updateRolesPermission(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all-roles-permission')->with($notification);


    }

    public function deleteRolesPermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }
}