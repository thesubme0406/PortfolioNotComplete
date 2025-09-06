<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <link rel="stylesheet" href="/css/layout.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <title>Portfolio</title>
</head>

<body>
    <div class="header flex flex-row justify-content-space-between">
        <a href="/">
            <div class="logo">meportfolio</div>
        </a>

        <nav class=" flex flex-row justify-content-space-around align-items-center">
            <a href="/" class="{{ Request::is('/') ? 'current' : '' }} text-link">Home</a>

            <a href="" class="social-media-link">
                <img src="https://img.icons8.com/fluent/28/000000/github.png" />
            </a>

            <a href="" class="social-media-link">
                <img src="https://img.icons8.com/metro/28/000000/linkedin.png" />
            </a>
        </nav>


    </div>
    @yield('content')

    <div class="footer flex flex-row justify-content-space-between bg-gray-200 px-[10%] py-[2vmax]">
        <nav class=" flex flex-row justify-content-space-around align-center">
            <a href="/" class="{{ Request::is('/') ? 'current' : '' }} text-link">Home</a>

            <a href="" class="social-media-link">
                <img src="https://img.icons8.com/fluent/28/000000/github.png" />
            </a>

            <a href="" class="social-media-link">
                <img src="https://img.icons8.com/metro/28/000000/linkedin.png" />
            </a>

        </nav>
        <a href="/">
            <div class="logo">meportfolio</div>
        </a>
    </div>
    <script>
        
        document.addEventListener("DOMContentLoaded", () => {
          document.querySelectorAll(".info-card, .contact-card, .skill-badge")
            .forEach((el, i) => {
              el.style.opacity = 0;
              el.style.transform = "translateY(10px)";
              setTimeout(() => {
                el.style.transition = "all 0.6s ease";
                el.style.opacity = 1;
                el.style.transform = "translateY(0)";
              }, i * 100);
            });
        });
      </script>
      
</body>

</html>
