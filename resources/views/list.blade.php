<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>
    </title>
  </head>
  @guest
  @endguest
  @auth
<body>
  @if (session('deleteerror'))
    <p class="text-danger mt-3">
      {{ session('deleteerror') }}
    </p>
  @endif
  @if (session('deleteok'))
    <p class="text-primary mt-3">
      {{ session('deleteok') }}
    </p>
  @endif
  <div class="container">
    <a href="/post">投稿</a>
    <table>
      <thead>
        <tr>
          <th style="width: 5%">id</th>
          <th style="width: 85%">内容</th>
          <th style="width: 5%">編集</th>
          <th style="width: 5%">削除</th>
        </tr>
      </thead>
      @foreach($posts as $post)
      <tbody>
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->contents}}</td>
          <td>
            <form action="{{action( 'PostController@edit')}}">
              @csrf
              <input type="hidden" name="id" value="{{$post->id}}">
              <input type="submit" class="btn btn-success" value="編集">
            </form>
          </td>
          <td><form class="" action="{{action( 'PostController@delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="delete" value="{{$post->id}}">
                    <input type="submit" class="btn btn-danger" value="削除">
              </form></td>
        </tr>
      </tbody>
      @endforeach
    </table>
    {{ $posts->links() }}
  </div>
</body>
@endauth
