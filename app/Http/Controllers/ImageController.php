<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scraping;
use App\Image;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Images;
use App\Grade;

class ImageController extends Controller
{
    public function ImageList(){
      $imagess = Scraping::orderBy('id','desc')->where('flg',3)->simplePaginate(40);
      $grades = Grade::where('type',1)->get();
      return view('imageList',compact('imagess','grades'));
    }

    public function ImageListKeyaki(){
      $imagess = Scraping::orderBy('id','desc')->where('flg',1)->simplePaginate(40);
      $grades = Grade::where('type',2)->get();
      return view('imageListKeyaki',compact('imagess','grades'));
    }

    public function ImageListHinata(){
      $imagess = Scraping::orderBy('id','desc')->where('flg',2)->simplePaginate(40);
      return view('imageListHinata',compact('imagess'));
    }

    public function serach(Request $request){
      $imagess = Scraping::orderBy('id','desc')->where('name',$request->name)->simplePaginate(40);
      return view('serach',compact('imagess'));
    }

    public function serach2(Request $request){
      $imagess = Scraping::orderBy('id','desc')->where('name',$request->name)->simplePaginate(40);
      return view('serach2',compact('imagess'));
    }
    public function date(Request $request){
      $imagess = Scraping::orderBy('id','desc')->where('date',$request->date)->where('flg',3)->simplePaginate(40);
      return view('searchdate',compact('imagess'));
    }
    public function dateh(Request $request){
      $imagess = Scraping::orderBy('id','desc')->where('date',$request->date)->where('flg',2)->simplePaginate(40);
      return view('searchdateh',compact('imagess'));
    }
    public function datek(Request $request){
      $imagess = Scraping::orderBy('id','desc')->where('date',$request->date)->where('flg',1)->simplePaginate(40);
      return view('searchdatek',compact('imagess'));
    }
}
