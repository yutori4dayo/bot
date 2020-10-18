<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <title>
    </title>
  </head>
  <body>
<style type="text/css">
  img{
    width: auto;
    height: 200px;
  }
  .wrap{
    display: flex;
    flex-wrap:wrap;
  }
  ul{
    display: flex;
  }
</style>
<div class="container py-3">
  <a href="{{asset('/image')}}" class="text-white"><button type="button" class="btn btn-primary">乃木坂</button></a>
  <a href="{{asset('/imageH')}}" class="text-white"><button type="button" class="btn btn-primary">日向坂</button></a>
  <form method="post" name="" action="{{url('/serach2')}}">
    @csrf
    <select class="form-control" name="name" id="exampleFormControlSelect1">
        @foreach($grades as  $grade)
        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
        @endforeach
        <input type="submit" name="" value="送信">
    </select>
  </form>
  <form class="" action="{{url('/datek')}}" method="post">
    @csrf
    <input type="text" id="datepicker" name="date">
    <input type="submit" name="" value="送信">
  </form>
  <div class="wrap d-flex">
  @foreach($imagess as $image)
    <div class="box">
        <p class="mb-0 pt-3">{{$image->name}} | {{$image->date}}</p>
        @php
          $images = unserialize($image->content);
        @endphp
        @foreach($images as $image)
        @if($image === null)
          <span></span>
        @else
        <a href="http://project1.yosiakiando.work/bot/public/kimg/{{$image}}"><img src="{{ asset('kimg/'.$image) }}"></a>
        @endif
        @endforeach
    </div>
  @endforeach
  </div>
</div>
{{$imagess->links()}}
<script type="text/javascript">
  $('#datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
  });
</script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
