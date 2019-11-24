<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Comment {
    
    public $comment_id;
    public $comment_text;
    public $picture_id;
    public $user_id;
    public $created_at;
    public $updated_at;
    
    public $uid;
    
    public function getByPost($id)
    {
        $result = DB::table('comment')
            ->select('*')
            ->join('user','user.user_id','=','comment.user_id')
            ->where('comment.picture_id','=',$id)
            ->orderBy('created_at','asc')
            ->get();
        
        return $result;
    } 
    
    public function get()
    {
        $result = DB::table('comment')
            ->select('*')
            ->where('comment_id',$this->comment_id)
            ->first();
        
        return $result;
    }
    
    public function insert()
    {
        $result = DB::table('comment')
        ->insert([
            'comment_text' => $this->comment_text,
            'picture_id'   => $this->picture_id,
            'user_id'      => $this->user_id,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ]);
        
        return $result;
    }
    
    public function update()
    {
        $result = DB::table('comment')
            ->where('comment_id',$this->comment_id)
            ->update([
                'comment_text' => $this->comment_text,
                'updated_at'   => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function deleteAdminComment()
    {
        $result = DB::table('comment')
            ->where('comment_id',$this->comment_id)
            ->delete();
        
        return $result;
    }
    
    public function deleteComment()
    {
        return DB::table('comment')
                ->where([
                    ['comment_id',$this->comment_id],
                    ['user_id',$this->user_id]
                ])
                ->delete();
    }
}
