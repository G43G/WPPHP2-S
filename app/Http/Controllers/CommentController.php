<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

use DateTime;

class CommentController extends Controller
{
    public function insertComment(Request $request, $id)
    {
        $rules = [
            'comment' => 'required'
        ];
        
        $messages = [
            'required' => 'You must comment something!'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $comment = new Comment();
            
            if(session()->has('user'))
            {
                $userId = session()->get('user')[0]->user_id;
            }
            
            $date = new DateTime();
            $date->format('d.m.Y H:i');
            
            $comment->comment_text = $request->get('comment');
            $comment->picture_id = $id;
            $comment->user_id = $userId;
            $comment->created_at = $date;
            $comment->updated_at = null;
            
            $comment->insert();
            
            return redirect()->back()->with('success', 'You have successfully commented!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding comment!');
        }
    }
    
    public function updateComment($id, $cId, Request $request)
    {
        $rules = 
        [
            'comment' => 'required'
        ];   
        
        $messages =
        [
            'required' => 'Field :attribute is required!',
        ]; 
        
        $request->validate($rules, $messages);
        
        try
        {
            $comment = new Comment();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $comment->comment_text = $request->get('comment');
            $comment->comment_id = $cId;
            $comment->updated_at = $date;
            
            $comment->update();
            
            return redirect('/pictures/'.$id)->with('success', 'You have successfully updated your comment!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating comment!');
        }
    }
    
    public function deleteComment(Request $request, $id, $cId)
    {
        try
        {
            $comment = new Comment();
            
            $comment->comment_id = $cId;
            
            $comment->user_id = $request->session()->get('user')[0]->user_id;
            
            $role = $request->session()->get('user')[0]->role_name;
            
            if($role == 'administrator')
            {
                $comment->deleteAdminComment();
                
                return redirect()->back()->with('success', 'Comment successfully deleted!');
            }
            else
            {
                $result = $comment->deleteComment();
                
                if($result == 1)
                {
                    return redirect()->back()->with('success', 'Comment successfully deleted!');
                }
                else
                {
                    return redirect(401);
                }
            }     
            
            return redirect()->back()->with('success', 'You have successfully deleted your comment!');
        } 
        catch(\Illuminate\Database\QueryException $ex) 
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting comment!');
        } 
    }
}
