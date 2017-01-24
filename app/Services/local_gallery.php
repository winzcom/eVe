<?php

namespace App\Service;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;

use App\Gallery;
use App\Interfaces\GalleryInterface;

class LocalGallery implements GalleryInterface{

    public function uploadPhotos(array $files,array $captions,string $name_slug){

       
        $names = [];
        $i = 0;
        if(is_array($files)){
            foreach($files as $key=>$file){
                $names[$key] = array($name_slug.$file->getClientOriginalName(),$captions[$i]);

                try{
                    
                    if($file->storeAs('public/images',$names[$key][0])){
                        Gallery::create(['image_name'=>$names[$key][0],'user_id'=>Auth::id(),'caption'=>htmlentities($captions[$i])]);

                    }
                }   
            
                catch(Exception $e){
                    return $e->message();
                }
            ++$i;
        }//end of foreach
        
        return $names;

    }
}

    public function deletePhotos(array $paths){

        $list  = array();
        if(is_array($paths)){
            foreach($paths as $path){
                File::delete(public_path().'/storage/images/'.$path);
               
            }  
           // $prefixed_array = preg_filter('/^/', $name_slug, $paths);
            //array_walk($paths, function(&$item) use ($name_slug){ $item *= $name_slug; });
             Gallery::whereIn('image_name',$paths)->where('user_id',Auth::user()->id)->delete();
            return ;
        }
        else{
                File::delete(public_path().'/storage/images/'.$paths);
                return;
        }
        

    }

}

?>