<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Navigation;

use DateTime;

class NavigationController extends Controller
{
    public function insertNavigation(Request $request)
    {
        $rules = 
        [
            'navigationNameAdmin' => 'required|unique:navigation,navigation_name',
            'navigationPathAdmin' => 'required',
            'navigationIconAdmin' => 'required'
        ];
        
        $messages = 
        [
            'required'                   => 'Field :attribute is required!',
            'navigationNameAdmin.unique' => 'Navigation name must be unique'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $navigation = new Navigation();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $navigation->navigation_name = $request->get('navigationNameAdmin');
            $navigation->navigation_path = $request->get('navigationPathAdmin');
            $navigation->navigation_icon = $request->get('navigationIconAdmin');
            $navigation->created_at = $date;
            $navigation->updated_at = null;
            
            $navigation->insert();
            
            return redirect('/admin-panel/navigation')->with('success', 'Navigation link successfully added!');
        }
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding navigation link!');
        }
    }
    
    public function updateNavigation($id, Request $request)
    {
        $rules = 
        [
            'navigationNameAdmin' => 'required',
            'navigationPathAdmin' => 'required',
            'navigationIconAdmin' => 'required'
        ];
        
        $messages = 
        [
            'required' => 'Field :attribute is required!',
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $navigation = new Navigation();
            
            $date = new DateTime();
            $date->format('d.m.Y H:i');
            
            $navigation->navigation_id = $id;
            $navigation->navigation_name = $request->get('navigationNameAdmin');
            $navigation->navigation_path = $request->get('navigationPathAdmin');
            $navigation->navigation_icon = $request->get('navigationIconAdmin');
            $navigation->updated_at = $date;
            
            $navigation->update();
            
            return redirect('/admin-panel/navigation')->with('success', 'Navigation link successfully updated!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating navigation link!');
        }
    }
    
    public function deleteNavigation($id)
    {
        try
        {
            $navigation = new Navigation();
            
            $navigation->navigation_id = $id;
            
            $navigation->delete();
            
            return redirect('/admin-panel/navigation')->with('success', 'Navigation link successfully deleted!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting navigation link!');
        } 
    }
}
