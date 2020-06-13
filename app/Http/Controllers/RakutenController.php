<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rakuten;

class RakutenController extends Controller
{
  public function getRakuten(Request $request){
    $keyword = urlencode($request->text);

    if($request->radio === null){
      $url = file_get_contents("https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?format=json&keyword='.$keyword.'&affiliateId=18d1c53c.99039d8b.18d1c53d.97f3420b&applicationId=1034515624161478389");
    }else {
      $radio = urlencode($request->radio);
      $url = file_get_contents("https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?format=json&genreId=".$radio."&keyword='.$keyword.'&affiliateId=18d1c53c.99039d8b.18d1c53d.97f3420b&applicationId=1034515624161478389");
    }

    $json = json_decode($url,true);
    $n = $json['hits'];
    if(Rakuten::truncate()){
      for ($i=0; $i <$n; $i++) {
          $datas = new Rakuten();
          $datas->name = $json['Items'][$i]['Item']['itemName'];
          $datas->image = $json['Items'][$i]['Item']['mediumImageUrls'][0]['imageUrl'];
          $datas->url = $json['Items'][$i]['Item']['affiliateUrl'];
          $datas->price = $json['Items'][$i]['Item']['itemPrice'];
          $datas->save();
      }
    }
    $datas = Rakuten::all();
    return view('result',compact('datas'));
  }
}
