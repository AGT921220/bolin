<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ Asset('login_asset/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ Asset('login_asset/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ Asset('login_asset/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ Asset('login_asset/css/style.css')}}">

    <title>Welcome</title>
  </head>
  <body>


  <div class="half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ Asset('login_asset/images/bg_1.jpg')  }}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6">
            <div class="form-block">
              <div class="text-center mb-5">
              <h3>Admin Panel</h3>

              @if(Session::has('error'))

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>ERROR : </strong> {{ Session::get('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
              </div>

              @endif

              @if(Session::has('message'))

              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>SUCCESS : </strong> {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
              </div>

              @endif

              </div>
              <form action="{{ Asset(env('store').'/login') }}" method="post">

              {!! csrf_field() !!}

                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" required="required">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" required="required" name="password" id="password">
                </div>

                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                </div>

                <input type="submit" value="Log In" class="btn btn-block btn-primary " style="background-color: #8E44AD">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  </body>
</html>
