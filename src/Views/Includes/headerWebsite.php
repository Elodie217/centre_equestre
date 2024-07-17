<?php ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Centre équestre</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
    <script src='fullcalendar/dist/index.global.js'></script>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>

<body class="text-lg scroll-smooth" style='font-family: "Poppins", sans-serif;'>
    <div class="blurred fixed w-full h-full top-0 backdrop-blur-sm hidden z-10"></div>
    <button type="button" onclick="closeSuccessMessage()" class="hidden toastSuccessMessage fixed right-4 top-4 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition-all transition duration-300 hover:bg-green-600">
        <div class="flex items-center space-x-2">
            <span class="text-3xl"><i class="fa-solid fa-check mr-2"></i></span>
            <p class="font-bold successMessage"></p>
        </div>
    </button>