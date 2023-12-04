<!DOCTYPE html>
<html lang="en">
<head>

     {{-- font AWESOME  --}}
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' integrity='sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==' crossorigin='anonymous'/>

     {{-- font GOOGLE  --}}
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest</title>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>
<body>

    @yield('content')

</body>
</html>
