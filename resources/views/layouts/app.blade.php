
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link href="{{ asset('css/style5.css') }}" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        @guest

        @else
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/home') }}">
                    <h5>{{ Auth::user()->role }} </h5>
                </a>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="{{ url('home') }}">Dashboard</a>
                </li>

                @if ((App\Helpers\Helper::has_permission(1,'read_m')==true) || (App\Helpers\Helper::has_permission(1,'create_m')==true))
                <li >
                    <a href="#postsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Posts
                    </a>
                    <ul class="collapse list-unstyled" id="postsSubmenu">
                        @if (App\Helpers\Helper::has_permission(1,'read_m')==true)
                        <li>
                            <a href="{{ url('listofpost') }}">List of Posts</a>
                        </li>
                        @endif

                        @if (App\Helpers\Helper::has_permission(1,'create_m')==true)
                        <li>
                            <a href="{{ url('addpost') }}">Add Post</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                @if ((App\Helpers\Helper::has_permission(2,'read_m')==true) || (App\Helpers\Helper::has_permission(2,'create_m')==true))
                <li>
                    <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Users
                    </a>
                    <ul class="collapse list-unstyled" id="usersSubmenu">
                        @if (App\Helpers\Helper::has_permission(2,'read_m')==true)
                        <li>
                            <a href="{{ url('listofusers') }}">List of Users</a>
                        </li>
                        @endif

                        @if (App\Helpers\Helper::has_permission(2,'create_m')==true)
                        <li>
                            <a href="{{ url('adduser') }}">Add User</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ((App\Helpers\Helper::has_permission(3,'read_m')==true) || (App\Helpers\Helper::has_permission(3,'create_m')==true))
                <li>
                    <a href="#tagsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Tags
                    </a>
                    <ul class="collapse list-unstyled" id="tagsSubmenu">

                        @if (App\Helpers\Helper::has_permission(3,'read_m')==true)
                        <li>
                            <a href="{{ url('tag') }}">List of Tags</a>
                        </li>
                        @endif


                        @if (App\Helpers\Helper::has_permission(3,'create_m')==true)
                        <li>
                            <a href="{{ url('addtag') }}">Add Tag</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if (App\Helpers\Helper::has_permission(4,'read_m')==true)
                <li>
                    <a href="{{ url('profile',Auth::user()->id) }}">Profile</a>
                </li>
                @endif
            </ul>
        </nav>
        @endguest

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                @guest
        
                    <div class="container-fluid">            
                        <div class="sidebar-header">
                            <a href="{{ url('/') }}">
                                <h5>Cubedots Test</h5>
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                 @else
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                 @endguest
            </nav>    

            @yield('content')
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>