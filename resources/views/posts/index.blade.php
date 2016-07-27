<!DOCTYPE html>
<html lang="en">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<div class="container">
    <form action="{{ route('posts.create') }}" method="POST">
        {{ csrf_field() }}
        <h3>Create Post</h3>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input name="subject" class="form-control">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-default">
        </div>
    </form>
    @foreach ($posts as $post)
        <div class="row">
            <h3>{{ $post->subject }}</h3>
            <p>
                {{ $post->body }} ({{ $post->likes()->count() }})
                <a href="#" class="btn btn-success glyphicon glyphicon-thumbs-up" name="like-post" data-post-id="{{ $post->id }}"></a>
            </p>
            <p>
            <h3>Comments</h3>
            @foreach ($post->comments as $comment)
                <div class="row">
                    {{ $comment->body }} ({{ $comment->likes()->count() }})
                    <a href="#" class="btn btn-success glyphicon glyphicon-thumbs-up" name="like-comment" data-comment-id="{{ $comment->id }}"></a>
                </div>
            @endforeach
            </p>
            <p>
            <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="text" name="body"><input type="submit" value="Comment">
            </form>
            </p>
        </div>
    @endforeach
</div>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"
        integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('[name="like-post"]').on('click', function (event) {
            post = $(event.target).attr('data-post-id');
            data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax('{{ route('posts.like') }}/' + post, {
                method: 'POST',
                data: data
            });
        });
        $('[name="like-comment"]').on('click', function (event) {
            comment = $(event.target).attr('data-comment-id');
            data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax('{{ route('posts.comment.like') }}/' + comment, {
                method: 'POST',
                data: data
            });
        });
    });
</script>
</html>