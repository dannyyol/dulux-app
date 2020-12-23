<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div id="wrapper">
        <div class="container welcome-container">
            <div class="image-center d-flex justify-content-center ">
                <img src="images/dulux_images/dulux_logo.png" alt="" srcset="" class="header-logo-image">
            </div>
            <h1 class="d-flex justify-content-center welcome-heading">Welcome</h1>
            <div class="row align-middle d-flex justify-content-center">
                <div class="col-sm-6 d-flex justify-content-center">
                    <button class="btn btn-lg btn-success btn-beginner"> I'm a Beginner</button>
                </div>
                <a href="colour.html" class="col-sm-6 d-flex justify-content-center ">
                    <a href="{{ route() }}" class="btn btn-lg btn-success btn-expert"> I'm an Expert</a>
                </a>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="btn btn-lg btn-primary btn-search">Search</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.min.js"></script>
</body>
</html>