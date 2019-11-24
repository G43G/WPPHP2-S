<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Picture {
    
    public $picture_id;
    public $picture_name;
    public $picture_show;
    public $picture_path;
    public $category_id;
    public $user_id;
    public $shared_at;
    public $updated_at;
    
    public function getAll()
    {
        $result = DB::table('picture')
            ->select('*','picture.updated_at as pictureUpdated')
            ->join('category','category.category_id','=','picture.category_id')
            ->join('user','user.user_id','=','picture.user_id')
            ->orderBy('picture_id')
            ->get();
        
        return $result;
    }
    
    public function getLimited()
    {
        $result = DB::table('picture')
            ->select('*')
            ->orderBy('picture_id','desc')
            ->limit(8)
            ->get();
        
        return $result;
    }
    
    public function getCategorized($cat)
    {
        $result = DB::table('picture')
        ->select('*')
        ->join('category','category.category_id','=','picture.category_id')
        ->join('user','user.user_id','=','picture.user_id')
        ->where('picture.category_id','=',$cat)
        ->orderBy('picture_id')
        ->get();
        
        return $result;
    }
    
    public function getByUser($id)
    {
        $result = DB::table('picture')
        ->select('*')
        ->join('category','category.category_id','=','picture.category_id')
        ->join('user','user.user_id','=','picture.user_id')
        ->where('picture.user_id','=',$id)
        ->orderBy('shared_at')
        ->get();
        
        return $result;
    }
    
    public function getSingle($id)
    {
        $result = DB::table('picture')
            ->select('*',\DB::raw("(SELECT count(views_id) FROM views WHERE picture_id = $id) as views"))
            ->join('category','category.category_id','=','picture.category_id')
            ->join('user','user.user_id','=','picture.user_id')
            ->where('picture.picture_id','=',$id)
            ->first();
        
        return $result;
    }
    
    public function get()
    {
        $result = DB::table('picture')
            ->select('*')
            ->where('picture_id',$this->picture_id)
            ->first();
        
        return $result;
    }

    public function insert()
    {
        $result = DB::table('picture')
        ->insert([
            'picture_name'  => $this->picture_name,
            'picture_show'  => $this->picture_show,
            'picture_path'  => $this->picture_path,
            'category_id'   => $this->category_id,
            'user_id'       => $this->user_id,
            'shared_at'     => $this->shared_at,
            'updated_at'    => $this->updated_at
        ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('picture')
            ->where('picture_id',$this->picture_id)
            ->update([
                'picture_name' => $this->picture_name,
                'picture_show' => $this->picture_show,
                'picture_path' => $this->picture_path,
                'category_id'  => $this->category_id,
                'user_id'      => $this->user_id,
                'updated_at'   => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function delete()
    {
        $result = DB::table('picture')
            ->where('picture_id',$this->picture_id)
            ->delete();
        
        return $result;
    }
    
    public function deleteMyPic()
    {
        $result = DB::table('picture')
            ->where([
                ['picture.user_id',$this->user_id],
                ['picture.picture_id',$this->picture_id]    
            ])
            ->delete();
        
        return $result;
    }
    
    public function getViews($id, $ip)
    {
        $result = DB::table('views')
            ->insert([
                'ip'         => $ip,
                'picture_id' => $id
            ]);
        
        return $result;
    }
}
