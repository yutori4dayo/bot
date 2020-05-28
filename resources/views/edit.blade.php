@guest
@endguest
@auth
<div class="container p-5">
  <form class="" action="/editPost" method="post">
    @csrf
    <textarea name="post" id="post" cols="100" rows="10">{{$post->contents}}</textarea>
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="submit" class="btn btn-primary" value="送信">
  </form>
</div>
@endauth
