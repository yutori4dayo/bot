<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title></title>
</head>
  <body>
    <style type="text/css">
      .content{
        width: 200px;
      }
    </style>
    <div class="container m-5 pl-5">
      <form class="" action="{{url('/getRakuten')}}" method="post">
        @csrf
        <input type="text" name="text" value="">
        <input type="submit" name="" value="送信">
        <div class="custom-control custom-radio">
          <input id="customRadio1" name="radio" type="radio" value="200162" class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">書籍</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="customRadio2" name="radio" type="radio" value="101240" class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">DVD</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="customRadio3" name="radio" type="radio" value="100433" class="custom-control-input">
          <label class="custom-control-label" for="customRadio3">ランジェリー</label>
        </div>
      </form>
    </div>
    @foreach($datas as $data)
    <div class="box d-flex pl-2">
      <div class="content">
        <img src="{{$data->image}}" alt="">
      </div>
      <input  type="text" value="{{$data->url}}" readonly>
      <!-- <div class="content">
        {{$data->price}}円
      </div> -->
    </div>
    @endforeach
  </body>
</html>
