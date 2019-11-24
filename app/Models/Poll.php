<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Poll {
    
    public $poll_id;
    public $user_id;
    public $answer_id;
    public $answer_id_alt;
    public $poll_question;
    public $poll_active;
    public $created_at;
    public $updated_at;
    public $answer;
    public $answer_alt;
    
    public function getAll()
    {
        $result = DB::table('poll')
            ->select('*')
            ->get();
        
        return $result;
    }
    
    public function getOne()
    {
        $result = DB::table('poll')
            ->select('*')
            ->join('answer','answer.poll_id','=','poll.poll_id')
            ->where('poll.poll_id','=',$this->poll_id)
            ->get();
        
        return $result;
    }
    
    public function get()
    {
     
        $result = DB::table('poll')
            ->select('*')
            ->join('answer','answer.poll_id','=','poll.poll_id')
            ->where('poll_active','=',1)
            ->get();
        
        return $result;
    }
    
    public function findUser()
    {
        $result = DB::table('vote')
            ->join('poll','poll.poll_id','=','vote.poll_id')
            ->where([
                ['vote.user_id','=',$this->user_id],
                ['poll.poll_active','=',1]
            ])
            ->first();
        
        return $result;
    }
    
    public function insertPoll()
    {
        $result = DB::table('poll')
            ->insertGetId([
                'poll_question' => $this->poll_question,
                'poll_active'   => 0,
                'created_at'    => $this->created_at
            ]);
        
        return $result;
    }
    
    public function updatePoll()
    {
        $result = DB::table('poll')
            ->where('poll_id','=',$this->poll_id)
            ->update([
                'poll_question' => $this->poll_question,
                'updated_at'    => $this->updated_at
            ]);
        
        return $result;
    }
    
    public function deletePoll()
    {
        return DB::table('poll')
            ->where('poll_id','=',$this->poll_id)
            ->delete();
    }
    
    public function insertFirstAnswer()
    {
        $result = DB::table('answer')
            ->insert([
                'poll_id'      => $this->poll_id,
                'answer'       => $this->answer,
                'answer_votes' => 0
            ]);
        
        return $result;
    }
    
    public function insertSecondAnswer()
    {
        $result = DB::table('answer')
            ->insert([
                'poll_id'      => $this->poll_id,
                'answer'       => $this->answer_alt,
                'answer_votes' => 0
            ]);
        
        return $result;
    }
    
    public function updateFirstAnswer()
    {
        $result = DB::table('answer')
            ->where([
                'poll_id' => $this->poll_id,
                'answer_id' => $this->answer_id
            ])
            ->update([
               'answer' => $this->answer
            ]);
        
        return $result;
    }
    
    public function updateSecondAnswer()
    {
        $result = DB::table('answer')
            ->where([
                'poll_id'   => $this->poll_id,
                'answer_id' => $this->answer_id_alt
            ])
            ->update([
                'answer' => $this->answer_alt
            ]);
        
        return $result;
    }
    
    public function deleteAnswer()
    {
        $result =  DB::table('answer')
            ->where('poll_id','=',$this->poll_id)
            ->delete();
        
        return $result;
    }
    
    public function incAnswer()
    {
        $result =  DB::table('answer')
            ->where('answer_id','=',$this->answer_id)
            ->increment('answer_votes',1);
        
        return $result;
    }
    
    public function insertVote()
    {
        $result = DB::table('vote')
            ->insertGetId([
                'poll_id' => $this->poll_id,
                'user_id' => $this->user_id
            ]);
        
        return $result;
    }
    
    public function deleteVote()
    {
        $result = DB::table('vote')
            ->where('poll_id','=',$this->poll_id)
            ->delete();
        
        return $result;
    }
    
    public function activate()
    {
        $result = DB::table('poll')
            ->where('poll_id','=',$this->poll_id)
            ->update([
                'poll_active' => 1
            ]);
        
        return $result;
    }
    
    public function deactivate()
    {
        $result = DB::table('poll')
            ->update([
                'poll_active' => 0
            ]);
        
        return $result;
    } 
}
