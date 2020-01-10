
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/assets/img/favicon.png">

    <title>QA Monitoring System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- CSS - REQUIRED - START -->
    <!-- Batch Icons -->
    <link rel="stylesheet" href="/assets/fonts/batch-icons/css/batch-icons.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="/assets/css/bootstrap/mdb.min.css">
    <!-- Custom Scrollbar -->
    <!-- <link rel="stylesheet" href="/assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css"> -->
    <!-- Hamburger Menu -->
    <!-- <link rel="stylesheet" href="/assets/css/hamburgers/hamburgers.css"> -->

    <!-- CSS - REQUIRED - END -->

    <!-- CSS - OPTIONAL - START -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- CSS - DEMO - START -->
    <link rel="stylesheet" href="/assets/demo/css/ui-icons-batch-icons.css">
    <!-- CSS - DEMO - END -->

    <!-- CSS - OPTIONAL - END -->

    <!-- QuillPro Styles -->
    <link rel="stylesheet" href="/assets/css/quillpro/quillpro.css">


    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance:textfield;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="right-column sisu">
                <div class="row mx-0">
                    <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark">
                        
                        <h1 class="display-4">Sign In To get Started</h1>
                        <p class="lead mb-5">
                            Big data latte SpaceTeam unicorn cortado hacker physical computing paradigm.
                        </p>
                    </div>
                    <div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
                        <a class="signin-logo d-sm-none d-md-block" href="#">
                            <img src="/assets/img/logo.png" alt="Flatworld">
                        </a>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee ID</label>
                                <input id="username" type="number" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           <!--  <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="keep-signed-in">
                                <label class="custom-control-label" for="keep-signed-in">Keep Me Signed In</label>
                            </div> -->
                            <button type="submit" class="btn btn-primary btn-gradient btn-block">
                                <i class="batch-icon batch-icon-key"></i>
                                Sign In
                            </button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS - REQUIRED START -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JavaScript -->
    <!-- JQuery -->
    <script type="text/javascript" src="/assets/js/jquery/jquery-3.1.1.min.js"></script>
    <!-- Popper.js - Bootstrap tooltips -->

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/assets/js/bootstrap/mdb.min.js"></script>
    <!-- Velocity -->

    <!-- Custom Scrollbar -->
    <script type="text/javascript" src="/assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

    
    <!-- SCRIPTS - OPTIONAL START -->
    <!-- Image Placeholder -->
    <script type="text/javascript" src="/assets/js/misc/holder.min.js"></script>
    <!-- SCRIPTS - OPTIONAL END -->

    <!-- QuillPro Scripts -->
    <script type="text/javascript" src="/assets/js/scripts.js"></script>
</body>

<!-- Mirrored from base5builder.com/livedemo/quillpro/v1.7/html/sisu-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Dec 2018 18:12:51 GMT -->
</html>
