<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use DateTime;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $rules = 
        [
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ];
        
        $messages = 
        [
            'required' => 'Field :attribute is required!'
        ];
        
        $request->validate($rules, $messages);

        $user = new User();

        $user->user_name = $request->get('usernameLogin');
        $user->user_pass = $request->get('passwordLogin');

        $userLogin = $user->getUser();

        if(!empty($userLogin))
        {
            $request->session()->push('user', $userLogin);
            
            if(session()->get('user')[0]->role_name == 'administrator')
            {
                return redirect('/admin-panel/users');
            }
            elseif(session()->get('user')[0]->role_name == 'user')
            {
                return redirect('/share');
            }
        }
        else
        {
            return redirect('/home')->with('error', 'There is no user with that username registered!');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();
        return redirect('/home');
    }
    
    public function register(Request $request)
    {
        $rules = [
            'emailRegister'     => ['regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/','required','unique:user,user_mail'],
            'usernameRegister'  => ['regex:/^[a-zA-Z0-9]{3,15}$/','required','unique:user,user_name','min:3','max:15'],
            'passwordRegister'  => ['regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/','required','confirmed','min:6']
        ];
        
        $messages = [
            'required'                  => 'Field :attribute is required!',
            'confirmed'                 => 'Passwords do not match!',
            'emailRegister.unique'      => 'E-mail is already registered!',
            'usernameRegister.unique'   => 'Username is already taken!',
            'emailRegister.regex'       => 'E-mail is not in valid format!',
            'usernameRegister.regex'    => 'Username is not in valid format!',
            'passwordRegister.regex'    => 'Password is not in valid format!'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $user = new User();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $user->user_mail = $request->get('emailRegister');
            $user->user_name = $request->get('usernameRegister');
            $user->user_pass = md5($request->get('passwordRegister'));
            $user->role_id = 2;
            $user->registered_at = $date;
            $user->changed_at = null;
            
            $user->insert();
            
            return redirect('/home')->with('success', 'You have successfully registered!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error with registering!');
        }
    }
    
    public function insertUser(Request $request)
    {
        $rules = [
            'userEmailAdmin'        => 'required|unique:user,user_mail',
            'userUsernameAdmin'     => 'required|unique:user,user_name',
            'userPasswordAdmin'     => 'required',
            'userRoleAdmin'         => 'not-in:0'
        ];
        
        $messages = [
            'required'                  => 'Field :attribute is required!',
            'userEmailAdmin.unique'     => 'E-mail must be unique!',
            'userUsernameAdmin.unique'  => 'Username must be unique!',
            'emailRegister.regex'       => 'E-mail is not in valid format!',
            'usernameRegister.regex'    => 'Username is not in valid format!',
            'passwordRegister.regex'    => 'Password is not in valid format!',
            'userRoleAdmin.not_in'      => 'Role must be selected!'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $user = new User();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $user->user_mail = $request->get('userEmailAdmin');
            $user->user_name = $request->get('userUsernameAdmin');
            $user->user_pass = md5($request->get('userPasswordAdmin'));
            $user->role_id = $request->get('userRoleAdmin');
            $user->registered_at = $date;
            $user->changed_at = null;
            
            $user->insert();
            
            return redirect('/admin-panel/users')->with('success', 'User successfully added!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding user!');
        }
    }
    
    public function updateUser($id, Request $request)
    {   
        $rules = 
        [
            'userEmailAdmin'        => 'required',
            'userUsernameAdmin'     => 'required',
            'userPasswordAdmin'     => 'required',
            'userRoleAdmin'         => 'not-in:0'
        ];
        
        $messages = 
        [
            'required'                  => 'Field :attribute is required!',
            'userEmailAdmin.unique'     => 'E-mail must be unique!',
            'userUsernameAdmin.unique'  => 'Username must be unique!',
            'emailRegister.regex'       => 'E-mail is not in valid format!',
            'usernameRegister.regex'    => 'Username is not in valid format!',
            'passwordRegister.regex'    => 'Password is not in valid format!',
            'userRoleAdmin.not_in'      => 'Role must be selected!'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $user = new User();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $user->user_id = $id;
            $user->user_mail = $request->get('userEmailAdmin');
            $user->user_name = $request->get('userUsernameAdmin');
            $user->role_id = $request->get('userRoleAdmin');
            $user->changed_at = $date;
            
            $pass = $request->get('userPasswordAdmin');
            
            if(strlen($pass) == 32)
            {
                $user->user_pass = $request->get('userPasswordAdmin');
            }
            else 
            {
                $user->user_pass = md5($request->get('userPasswordAdmin'));
            }
            
            $user->update();
            
            return redirect('/admin-panel/users')->with('success', 'User successfully updated!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating user!');
        } 
    }
    
    public function deleteUser($id)
    {
        try
        {
            $user = new User();
            
            $user->user_id = $id;
            
            $user->delete();
            
            return redirect('/admin-panel/users')->with('success', 'User successfully deleted!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting user!');
        } 
    }
    
    public function changeUser($id, Request $request)
    {   
        $rules = 
        [
            'userEmailChange'        => ['regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/','required'],
            'userUsernameChange'     => ['regex:/^[a-zA-Z0-9]{3,15}$/','required','min:3','max:15'],
            'userPasswordChange'     => ['regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/','required','min:6']
        ];
        
        $messages = 
        [
            'required'                  => 'Field :attribute is required!',
            'userEmailChange.regex'       => 'E-mail is not in valid format!',
            'userUsernameChange.regex'    => 'Username is not in valid format!',
            'userPasswordChange.regex'    => 'Password is not in valid format!',
        ];
        
        $request->validate($rules, $messages);        

        try
        {
            $user = new User();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $user->user_id = $id;
            $user->user_mail = $request->get('userEmailChange');
            $user->user_name = $request->get('userUsernameChange');
            $user->changed_at = $date;
            
            $pass = $request->get('userPasswordChange');
            
            if(strlen($pass) == 32)
            {
                $user->user_pass = $request->get('userPasswordChange');
            }
            else 
            {
                $user->user_pass = md5($request->get('userPasswordChange'));
            }
            
            $result = $user->change();
            
            if($result == 1)
            {
            
            return redirect('/share')->with('success', 'You have successfully updated your profile!');
            }
            else
            {
                abort(404);
            }
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating profile!');
        } 
    }
}
