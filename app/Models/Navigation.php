<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Navigation {
    
    public $navigation_id;
    public $navigation_name;
    public $navigation_path;
    public $navigation_icon;
    public $created_at;
    public $updated_at;
    
    public function getAll()
    {
            $result = DB::table('navigation')
                ->select('*')
                ->get();
        
            return $result; 
    }
    
    public function get()
    {
        $result = DB::table('navigation')
            ->select('*')
            ->where('navigation_id',$this->navigation_id)
            ->first();
        
        return $result;
    }
    
    public function getAuth()
    {
            $result = DB::table('navigation')
                ->select('*')
                ->whereNotIn('navigation_id', [4])
                ->get();
        
            return $result; 
    }
    
    public function getNoAuth()
    {
            $result = DB::table('navigation')
                ->select('*')
                ->whereNotIn('navigation_id', [3,4,6])
                ->get();
        
            return $result; 
    }
    
    public function insert()
    {
        $result = DB::table('navigation')
        ->insert([
            'navigation_name' => $this->navigation_name,
            'navigation_path' => $this->navigation_path,
            'navigation_icon' => $this->navigation_icon,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at 
        ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('navigation')
            ->where('navigation_id',$this->navigation_id)
            ->update([
                'navigation_name' => $this->navigation_name,
                'navigation_path' => $this->navigation_path,
                'navigation_icon' => $this->navigation_icon,
                'updated_at'      => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function delete()
    {
        $result = DB::table('navigation')
            ->where('navigation_id',$this->navigation_id)
            ->delete();
        
        return $result;
    }
}
