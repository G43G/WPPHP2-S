<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

use App\Models\Picture;

use DateTime;

class PictureController extends Controller
{   
    public function insertPicture(Request $request)
    {
        $rules = 
        [
            'pictureNameAdmin'      => 'required|unique:picture,picture_name',
            'pictureFileAdmin'      => 'required|mimes:jpg,jpeg',
            'pictureCategoryAdmin'  => 'not_in:0',
            'pictureUserAdmin'      => 'not_in:0'
        ];
        
        $messages =
        [
            'required'                      => 'Field :attribute is required!',
            'pictureNameAdmin.unique'       => 'Picture name must be unique!',
            'mimes'                         => 'Picture is not in valid format! Allowed formats are :values.',
            'pictureCategoryAdmin.not_in'   => 'Category must be selected!',
            'pictureUserAdmin.not_in'       => 'User must be selected!'
        ];
        
        $request->validate($rules, $messages);
        
        $image = $request->file('pictureFileAdmin');
        $extension = $image->getClientOriginalExtension();
        $tmp_path = $image->getPathName();
        
        $folder = 'images/fulls/';
        $file_name = time().".".$extension;
        $new_path = public_path($folder).$file_name;
        
        $thumb_image = Image::make($image->getRealPath());
        $thumb_image->resize(450, 450);
        
        try
        {   
            File::move($tmp_path, $new_path);
            $thumb_image->save(public_path('images/thumbs/'.$file_name));
            
            $picture = new Picture();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $picture->picture_name = $request->get('pictureNameAdmin');
            $picture->picture_show = 'images/thumbs/'.$file_name;
            $picture->picture_path = 'images/fulls/'.$file_name;
            $picture->category_id = $request->get('pictureCategoryAdmin');
            $picture->user_id = $request->get('pictureUserAdmin');
            $picture->shared_at = $date;
            $picture->updated_at = null;
            
            $picture->insert();
            
            return redirect('/admin-panel/pictures/')->with('success', 'Picture successfully added!');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while adding picture!');
        }
        catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error with picture upload!');
        }
    }
    
    public function updatePicture($id, Request $request) 
    {
        $rules = 
            [
                'pictureNameAdmin'      => 'required',
                'pictureCategoryAdmin'  => 'not_in:0',
                'pictureUserAdmin'      => 'not_in:0'
            ];
        
        $messages =
        [
            'required'                      => 'Field :attribute is required!',
            'pictureCategoryAdmin.not_in'   => 'Category must be selected!',
            'pictureUserAdmin.not_in'       => 'User must be selected!'
        ];
        
        $request->validate($rules, $messages);
        
        try
        {
            $picture = new Picture();
            
            $date = new DateTime();
            $date->format('d.m.Y');
        
            $picture->picture_id = $id;
            $picture->picture_name = $request->get('pictureNameAdmin');
            $picture->category_id = $request->get('pictureCategoryAdmin');
            $picture->user_id = $request->get('pictureUserAdmin');
            $picture->picture_show = $picture->get()->picture_show;
            $picture->picture_path = $picture->get()->picture_path;
            $picture->updated_at = $date;
            
            $image = $request->file('pictureFileAdmin');
            
            if(!empty($image))
            {
                $picture_to_update = $picture->get();
                File::delete($picture_to_update->picture_path);
                File::delete($picture_to_update->picture_show);

                $extension = $image->getClientOriginalExtension();
                $tmp_path = $image->getPathName();

                $folder = 'images/fulls/';
                $file_name = time().".".$extension;
                $new_path = public_path($folder).$file_name;

                $thumb_image = Image::make($image->getRealPath());
                $thumb_image->resize(450, 450);

                $picture->picture_show = 'images/thumbs/'.$file_name;
                $picture->picture_path = 'images/fulls/'.$file_name;

                File::move($tmp_path, $new_path);
                $thumb_image->save(public_path('images/thumbs/'.$file_name));
            }
            
            $picture->update();
            
            return redirect('/admin-panel/pictures')->with('success', 'Picture successfully updated!');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
             \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while updating picture!');           
        }
        catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error with picture upload!');
        }
    }
    
    public function deletePicture($id)
    {
        try
        {
            $picture = new Picture();
            $picture->picture_id = $id;

            $picture_to_delete = $picture->get();
            File::delete($picture_to_delete->picture_path);
            File::delete($picture_to_delete->picture_show);

            $picture->delete();

            return redirect()->back()->with('success','Picture successfully deleted!');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while deleting picture!');
        }
    }
    
    public function sharePicture(Request $request)
    {
        $rules = 
        [
            'pictureName'       => 'required|unique:picture,picture_name',
            'pictureUpload'     => 'required|mimes:jpg,jpeg',
            'pictureCategory'   => 'not_in:0'
        ];
        
        $messages =
        [
            'required'               => 'Field :attribute is required!',
            'pictureName.unique'     => 'Picture name must be unique!',
            'mimes'                  => 'Picture is not in valid format! Allowed formats are :values.',
            'pictureCategory.not_in' => 'Category must be selected!'
        ];
        
        $request->validate($rules, $messages);
        
        $image = $request->file('pictureUpload');
        $extension = $image->getClientOriginalExtension();
        $tmp_path = $image->getPathName();
        
        $folder = 'images/fulls/';
        $file_name = time().".".$extension;
        $new_path = public_path($folder).$file_name;
        
        $thumb_image = Image::make($image->getRealPath());
        $thumb_image->resize(450, 450);
        
        try
        {   
            File::move($tmp_path, $new_path);
            $thumb_image->save(public_path('images/thumbs/'.$file_name));
            
            $picture = new Picture();
            
            $date = new DateTime();
            $date->format('d.m.Y');
            
            $picture->picture_name = $request->get('pictureName');
            $picture->picture_show = 'images/thumbs/'.$file_name;
            $picture->picture_path = 'images/fulls/'.$file_name;
            $picture->category_id = $request->get('pictureCategory');
            $picture->user_id = session()->get('user')[0]->user_id;
            $picture->shared_at = $date;
            $picture->updated_at = null;
            
            $picture->insert();
            
            return redirect('/share')->with('success', 'You have successfully shared picture!');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error while sharing picture!');
        }
        catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex)
        {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error with picture upload!');
        }
    }
    
    public function deleteMyPicture($id, Request $request)
    {
        if(session()->has('user'))
        {
            try
            {
                $picture = new Picture();

                $picture->user_id = $request->session()->get('user')[0]->user_id;
                $picture->picture_id = $id;

                $picture->deleteMyPic();

                return redirect('/share')->with('success','You have successfully deleted your picture!');
            }
            catch(\Illuminate\Database\QueryException $ex) 
            {
                \Log::error($ex->getMessage());
                return redirect()->back()->with('error', 'Error while deleting picture!');
            }
        }
        else
        {
            return redirect('401');
        }
    }
}