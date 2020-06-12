<style type="text/css">
  img{
    width: auto;
    height: 200px;
  }
  .wrap{
    display: flex;
    flex-wrap:wrap;
  }
</style>
<div class="wrap">
@foreach($images as $image)
  <div class="box">
    <a href="{{$image->content}}" download><img src="{{$image->content}}"></a>
  </div>
@endforeach
</div>
