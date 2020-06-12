<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta charset="utf-8">
    <title></title>
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
  <div class="wrap d-flex">
  @foreach($images as $image)
    <div class="box">
      @if($image->img === '0')
        <a href="{{$image->content}}" download><img src="{{$image->content}}"></a>
      @else
        <a><img src="{{ asset('img/'.$image->img) }}"></a>
      @endif
      @if($image->img === '0')
      <form class="" action="{{url('/getImage')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="">
          <input type="file" name="image" value="">
          <input type="hidden" name="id" value="{{$image->id}}">
        </div>
        <div class="">
          <input type="submit" name="" value="送信">
        </div>
      </form>
      @endif
    </div>
  @endforeach
  </div>
</div>
<div class="">
  {{$images->links()}}
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
