<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstracts</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }    
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <!-- Your header content here -->
    <!-- <h1>Welcome to Our Website!</h1>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </nav> -->
</header>

<main>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
           
            <!-- Banner Image -->
            <div>
                <img class="w-100" src="{{ asset('assets/eighc-eaheader-650.jpg') }}" alt="eighc banner">
            </div>
            @yield('content') <!-- This will inject the content from welcome.blade.php -->
            @yield('scripts') <!-- This will inject the scripts from welcome.blade.php -->
        </div>
    </div>
</div>
</main>


    <!-- <footer class="col-lg-10 col-xl-8">
    
        <p>&copy; {{ date('Y') }} Meeting Minds FZ LLC. All rights reserved.</p>
    </footer> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script></body>
</body>
</html>