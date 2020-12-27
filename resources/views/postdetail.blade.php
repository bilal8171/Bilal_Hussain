<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Post Details</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('frontend/css/blog-home.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Cubedots Test</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          @if (Route::has('login'))
            @auth
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">My Account
                  <span class="sr-only">(current)</span>
                </a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                  </li>
                @endif
            @endauth
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <!-- Blog Post -->              
        @if (isset($posts))

          <h1 class="my-4">{{ $posts->title }}</h1>
          <?php
            $getPer=DB::table('users')->where('id',$posts->users_id)->first();
          ?>
          <div class="card mb-4">
            <img class="card-img-top" src="{{ App\Helpers\Helper::geturlimage('featured_image/thumbnail/'.$posts->featured_image) }}" alt="Card image cap" style="height: 223px;">
            <div class="card-body">
              <p class="card-text">{{ $posts->description }}</p>
            </div>
            <div class="card-footer text-muted">
              Posted on {{ App\Helpers\Helper::changedateformte($posts->created_at,'M d , Y ') }} by
              <a href="javascript:void(0)">{{ $getPer->name }}</a>
            </div>
          </div>
        @endif

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Tags Widget -->
        <div class="card my-4">
          <h5 class="card-header">Tags</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled mb-0">                  
                  @if (isset($tags))
                    @foreach ($tags as $row)
                      <li>
                        <a href="{{ url('tagfilter',$row->id) }}">{{ $row->tag_name }}</a>
                      </li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Cubedots Pvt Ltd 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
