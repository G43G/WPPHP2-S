<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

use DateTime;

class RoleController extends Controller
{
    public function insertRole(Request $request)
    {
        $rules = 
        [
            'roleNameAdmin' => 'required|unique:role,role_name'
        ];   
        
        $messages =
        [
            'required'             => 'Field :attribute is required!',
            'roleNameAdmin.unique' => 'Role name must be unique!',
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $role = new Role();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $role->role_name = $request->get('roleNameAdmin');
            $role->created_at = $date;
            $role->updated_at = null;
            
            $role->insert();
            
            return redirect('/admin-panel/roles')->with('success', 'Role successfully added!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding role!');
        }
    }
    
    public function updateRole($id, Request $request)
    {
        $rules = 
        [
            'roleNameAdmin' => 'required'
        ];   
        
        $messages =
        [
            'required' => 'Field :attribute is required!',
        ]; 
        
        $request->validate($rules, $messages);
        
        try
        {
            $role = new Role();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $role->role_id = $id;
            $role->role_name = $request->get('roleNameAdmin');
            $role->updated_at = $date;
            
            $role->update();
            
            return redirect('/admin-panel/roles')->with('success', 'Role successfully updated!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating role!');
        }
    }
    
    public function deleteRole($id)
    {
        try
        {
            $role = new Role();
            
            $role->role_id = $id;
            
            $role->delete();
            
            return redirect('/admin-panel/roles')->with('success', 'Role successfully deleted!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting role!');
        } 
    }
}
