<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <!-- Bootstrap CSS -->
    <!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Include Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Include Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.1/dist/nepaliDatePicker.min.css" crossorigin="anonymous" /> --}}




  <!-- Custom CSS -->
  <style>
    .form-section {
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .form-section.active {
        display: block;
        opacity: 1;
        transform: translateX(0);
    }

    .form-section.entering-from-right {
        display: block;
        opacity: 0;
        transform: translateX(100%);
    }

    .form-section.entering-from-left {
        display: block;
        opacity: 0;
        transform: translateX(-100%);
    }

    .form-section.exiting-to-left {
        display: block;
        opacity: 0;
        transform: translateX(-100%);
    }

    .form-section.exiting-to-right {
        display: block;
        opacity: 0;
        transform: translateX(100%);
    }
</style>




</head>
<body style="margin-top: 100px;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">My App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

     <!-- Include jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Include Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
     <!-- Include Select2 JS -->
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     {{-- <script src="https://unpkg.com/nepali-date-picker@2.0.1/dist/jquery.nepaliDatePicker.min.js" crossorigin="anonymous"></script> --}}
     <script src="https://cdn.jsdelivr.net/npm/nepali-date-converter/dist/nepali-date-converter.umd.js"></script>



     <script>


     </script>
 
</body>
</html>
