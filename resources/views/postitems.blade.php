<form class="" action="{{url('/createitem')}}" method="post">
  @csrf
  <textarea name="content" rows="8" cols="80"></textarea>
  <input type="submit" name="" value="送信">
</form>
