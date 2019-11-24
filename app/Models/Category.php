<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Category {
    
    public $category_id;
    public $category_name;
    public $created_at;
    public $updated_at;
    
    public function getAll()
    {
        $result = DB::table('category')
            ->select('*')
            ->get();
        
        return $result;
    }
    
    public function get()
    {
        $result = DB::table('category')
            ->select('*')
            ->where('category_id',$this->category_id)
            ->first();
        
        return $result;
    }
    
    public function insert()
    {
        $result = DB::table('category')
        ->insert([
            'category_name' => $this->category_name,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('category')
            ->where('category_id',$this->category_id)
            ->update([
                'category_name' => $this->category_name,
                'updated_at'    => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function delete()
    {
        $result = DB::table('category')
            ->where('category_id',$this->category_id)
            ->delete();
        
        return $result;
    }
}
