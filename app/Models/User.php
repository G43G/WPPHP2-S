<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User {
    
    public $user_id;
    public $user_mail;
    public $user_name;
    public $user_pass;
    public $role_id;
    public $registered_at;
    public $changed_at;
    
    public function getAll()
    {
        $result = DB::table('user')
            ->select('*')
            ->join('role','role.role_id','=','user.role_id')
            ->get();
        
        return $result;
    }
    
    public function getUser()
    {
        $result = DB::table('user')
            ->select('user.*','role.role_name')
            ->join('role','role.role_id','=','user.role_id')
            ->where([
                'user_name' => $this->user_name,
                'user_pass' => md5($this->user_pass)
            ])
            ->first();
        
        return $result;
    }
    
    public function getProfile($id)
    {
        $result = DB::table('user')
            ->select('*')
            ->where('user_id','=',$id)
            ->first();
        
        return $result; 
    }
    
    public function get()
    {
        $result = DB::table('user')
            ->select('*')
            ->where('user_id',$this->user_id)
            ->first();
        
        return $result;
    }
    
    public function insert()
    {
        $result = DB::table('user')
            ->insert([
                'user_mail'     => $this->user_mail,
                'user_name'     => $this->user_name,
                'user_pass'     => $this->user_pass,
                'role_id'       => $this->role_id,
                'registered_at' => $this->registered_at,
                'changed_at'    => $this->changed_at
            ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('user')
            ->where('user_id',$this->user_id)
            ->update([
                'user_mail'  => $this->user_mail,
                'user_name'  => $this->user_name,
                'user_pass'  => $this->user_pass,
                'role_id'    => $this->role_id,
                'changed_at' => $this->changed_at
            ]);
        
        return $result;
    }
    
    public function delete()
    {
        $result = DB::table('user')
            ->where('user_id',$this->user_id)
            ->delete();
        
        return $result;
    }
    
    public function change()
    {
        $result = DB::table('user')
            ->where('user_id',$this->user_id)
            ->update([
                'user_mail'  => $this->user_mail,
                'user_name'  => $this->user_name,
                'user_pass'  => $this->user_pass,
                'changed_at' => $this->changed_at
            ]);
        
        return $result;
    }
}
