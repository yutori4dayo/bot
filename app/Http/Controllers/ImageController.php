<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scraping;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function ImageList(){
      $images = Scraping::orderBy('id','desc')->paginate(40);
      return view('imageList',compact('images'));
    }

    public function getImage(Request $request){
      $ext = '.jpg';
      $val = $request->file('image');
      $img = Image::make($val);
      $uniq = uniqid("img_").$ext;
      Scraping::where('id',$request->id)->update(['img'=>$uniq]);
      $save_path = public_path('img/'.$uniq);
      if($img->save($save_path)){
        return redirect('image');
      }
    }
}
