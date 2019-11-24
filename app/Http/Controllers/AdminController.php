<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\Poll;

class AdminController extends Controller
{
    private $data = [];
    
    public function __construct() 
    {
        $navigation = new Navigation();
        $this->data['navigations'] = $navigation->getAll(); 
    }
    
    public function showUsers($id = null)
    {
        try
        {
            $user = new User();
            $role = new Role();
            $user->user_id = $id;
            $this->data['users'] = $user->getAll();
            $this->data['roles'] = $role->getAll();
            $this->data['selectedUser'] = $user->get();
            return view('admin.adminUser', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showPictures($id = null)
    {
        try
        {
            $picture = new Picture();
            $category = new Category();
            $user = new User();
            $picture->picture_id = $id;
            $this->data['pictures'] = $picture->getAll();
            $this->data['categories'] = $category->getAll();
            $this->data['users'] = $user->getAll();          
            $this->data['selectedPicture'] = $picture->get();
            return view('admin.adminPicture', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showCategories($id = null)
    {
        try
        {
            $category = new Category();
            $category->category_id = $id;
            $this->data['categories'] = $category->getAll();
            $this->data['selectedCategory'] = $category->get();
            return view('admin.adminCategory', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showNavigation($id = null)
    {
        try
        {
            $navigation = new Navigation();
            $navigation->navigation_id = $id;
            $this->data['navigations'] = $navigation->getAll();
            $this->data['selectedNavigation'] = $navigation->get();
            return view('admin.adminNavigation', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showRoles($id = null)
    {
        try
        {
            $role = new Role();
            $role->role_id = $id;
            $this->data['roles'] = $role->getAll();
            $this->data['selectedRole'] = $role->get();
            return view('admin.adminRoles', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showPolls($id = null)
    {
        try
        {
            $poll = new Poll();
            $poll->poll_id = $id;
            $this->data['polls'] = $poll->getAll();
            
            if(!empty($id))
            {
                $this->data['selectedPoll'] = $poll->getOne();
            }
            
            return view('admin.adminPolls', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
}