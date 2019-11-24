<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Poll;

use DateTime;

class PollController extends Controller
{
    public function showPoll()
    {   
        try
        {
            $poll = new Poll();
            
            $myPoll = $poll->get();
            
            return response($myPoll, 200);
    	}
    	catch(\Exception $ex)
        {
            \Log::error($ex->getMessage());
            return response(null, 500);
    	}
    }
    
    public function insertPoll(Request $request)
    {
        $request->validate([
            'pollQuestionAdmin'   => 'required',
            'pollFirstAnswer'     => 'required',
            'pollSecondAnswer' => 'required'
        ],[
            'required' => 'Field :attribute is required!'
        ]);
        
        $question = $request->get('pollFirstAnswer');
        $answer = $request->get('pollFirstAnswer');
        $answer_alt = $request->get('pollSecondAnswer');
        
        try 
        {
            $poll = new Poll();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $poll->poll_question = $question;
            $poll->answer = $answer;
            $poll->answer_alt = $answer_alt;
            $poll->created_at = $date;
            $poll->updated_at = null;
            $poll->poll_id = $poll->insertPoll();
            $poll->insertFirstAnswer();
            $poll->insertSecondAnswer();
            return redirect('/admin-panel/polls')->with('success', 'Poll successfully added!');
            
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding poll!');
        }
    }
    
    public function updatePoll(Request $request, $id)
    {
        $rules = 
        [
            'pollQuestionAdmin' => 'required',
            'pollFirstAnswer'   => 'required',
            'pollSecondAnswer'  => 'required'
        ];
        
        $messages = 
        [
            'required' => 'Field :attribute is required!'
        ];
        
        $request->validate($rules, $messages);
        
        try 
        {
            $poll = new Poll();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $poll->poll_id = $id;
            $poll->poll_question = $request->get('pollQuestionAdmin');
            $poll->answer = $request->get('pollFirstAnswer');
            $poll->answer_alt = $request->get('pollSecondAnswer');
            $poll->updated_at = $date;
            $poll->answer_id = $request->get('answer');
            $poll->answer_id_alt = $request->get('answer_alt');
            
            $poll->updateFirstAnswer();
            $poll->updateSecondAnswer();
            
            $poll->updatePoll();

            return redirect('/admin-panel/polls')->with('success', 'Poll updated successfully!');

        }
        catch(\Exception $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating poll!');
        }
    }
    
    public function deletePoll($id)
    {
        try 
        {
            $poll = new Poll();
            
            $poll->poll_id = $id;
            
            $poll->deleteVote();
            
            $poll->deleteAnswer();
            
            $poll->deletePoll();

            return redirect('/admin-panel/polls')->with('success', 'Poll successfully deleted!');
        }
        catch(\Exception $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting poll!');
        }
    }
    
    public function insertVote(Request $request)
    {
        $poll = new Poll();
        
        $poll->user_id = $request->get('user_id');
        $poll->poll_id = $request->get('poll_id');
        $poll->answer_id = $request->get('answer_id');
        
        try 
        {
            $result = $poll->insertVote();
            
            $poll->incAnswer();
            
            return response($result, 200);
        } 
        catch (\Exception $ex) 
        {
            \Log::error($ex->getMessage());
            return response(null, 500);
        }
    }

    public function activatePoll($id)
    {
        try 
        {
            $poll = new Poll();
            
            $poll->poll_id = $id;
            
            $poll->deactivate();
            $poll->activate();
            
            return redirect('/admin-panel/polls')->with('success', 'Poll activated successfully!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while activating poll!');
        }
    }
}
