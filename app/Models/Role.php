<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Role {
    
    public $role_id;
    public $role_name;
    public $created_at;
    public $updated_at;
    
    public function getAll()
    {
        $result = DB::table('role')
            ->select('*')
            ->get();
        
        return $result;
    }
    
    public function get()
    {
        $result = DB::table('role')
            ->select('*')
            ->where('role_id',$this->role_id)
            ->first();
        
        return $result;
    }
    
    public function insert()
    {
        $result = DB::table('role')
        ->insert([
            'role_name'  => $this->role_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('role')
            ->where('role_id',$this->role_id)
            ->update([
                'role_name'  => $this->role_name,
                'updated_at' => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function delete()
    {
        $result = DB::table('role')
            ->where('role_id',$this->role_id)
            ->delete();
        
        return $result;
    }
}
