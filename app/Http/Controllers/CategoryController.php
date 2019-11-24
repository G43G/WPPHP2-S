<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use DateTime;

class CategoryController extends Controller
{
    public function insertCategory(Request $request)
    {
        $rules = 
        [
            'categoryNameAdmin' => 'required|unique:category,category_name'
        ];   
        
        $messages =
        [
            'required'                 => 'Field :attribute is required!',
            'categoryNameAdmin.unique' => 'Picture name must be unique!',
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $category = new Category();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $category->category_name = $request->get('categoryNameAdmin');
            $category->created_at = $date;
            $category->updated_at = null;
            
            $category->insert();
            
            return redirect('/admin-panel/categories')->with('success', 'Category successfully added!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding category!');
        }
    }
    
    public function updateCategory($id, Request $request)
    {
        $rules = 
        [
            'categoryNameAdmin' => 'required'
        ];   
        
        $messages =
        [
            'required' => 'Field :attribute is required!',
        ]; 
        
        $request->validate($rules, $messages);
        
        try
        {
            $category = new Category();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $category->category_id = $id;
            $category->category_name = $request->get('categoryNameAdmin');
            $category->updated_at = $date;
            
            $category->update();
            
            return redirect('/admin-panel/categories')->with('success', 'Category successfully updated!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating category!');
        }
    }
    
    public function deleteCategory($id)
    {
        try
        {
            $category = new Category();
            
            $category->category_id = $id;
            
            $category->delete();
            
            return redirect('/admin-panel/categories')->with('success', 'Category successfully deleted!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting category!');
        } 
    }
}
