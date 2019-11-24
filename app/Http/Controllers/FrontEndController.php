<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Navigation;
use App\Models\User;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Comment;

class FrontEndController extends Controller
{
    private $data = [];
    
    public function __construct() 
    {
        $navigation = new Navigation();
        $poll = new Poll();
        $this->data['navigations'] = $navigation->getAll();
        $this->data['authNavigations'] = $navigation->getAuth();
        $this->data['noAuthNavigations'] = $navigation->getNoAuth();
        $this->data['polls'] = $poll->getAll();
    }
    
    public function getHome(Request $request)
    {
        if($request->session()->has('user'))
        {
            $idUser = $request->session()->get('user')[0]->user_id;
            $poll = new Poll();
            $poll->user_id = $idUser;
            $result = $poll->findUser();
            if($result)
            {
                $this->data['result'] = $result;
            }
            else
            {
                $this->data['result'] = $result;
            }
        }

        $picture = new Picture();
        $this->data['pictures'] = $picture->getLimited(); 
        return view('pages.home', $this->data);
    }
    
    public function getGallery()
    {
        try
        {
            $picture = new Picture();
            $category = new Category();
            $this->data['pictures'] = $picture->getAll();
            $this->data['categories'] = $category->getAll();
            return view('pages.gallery', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function showCategorized($cat)
    {
        try
        {
            $picture = new Picture();
            $catData = $picture->getCategorized($cat);
            return view('ajax.ajaxGallery', array('cats'=>$catData));
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getShare()
    {
        try
        {
            $picture = new Picture();
            $user = new User();
            $category = new Category();

            if(session()->has('user'))
            {
                $id = session()->get('user')[0]->user_id;
                $this->data['pictures'] = $picture->getByUser($id);
                $this->data['loggedUsers'] = $user->getProfile($id);
                $this->data['categories'] = $category->getAll();
                return view('pages.share', $this->data);
            }
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getAdmin()
    {
        try
        {
            $user = new User();
            $this->data['users'] = $user->getAll();
            return view('pages.admin', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getInformation()
    {
        try
        {
            return view('pages.information', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getPicture(Request $request, $id, $cId = null)
    {  
        try
        {   
            $user = new User();
            $picture = new Picture();
            $picture->getViews($id, $request->ip());
            $comment = new Comment();
            $comment->comment_id = $cId;
            $this->data['users'] = $user->getAll();
            $this->data['pictures'] = $picture->getAll();
            $this->data['singlePicture'] = $picture->getSingle($id);
            $this->data['comments'] = $comment->getByPost($id);
            $this->data['selectedComment'] = $comment->get();
            return view('pages.picture', $this->data);
        }
        catch(Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    } 
    
    public function download()
    {
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download(public_path('documentation.pdf'), 'documentation.pdf', $headers);
    }
}
