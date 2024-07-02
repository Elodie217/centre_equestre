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

</head>

<body class="text-lg scroll-smooth">
    <div class="blurred fixed w-full h-full top-0 backdrop-blur-sm hidden z-10"></div>
    <button type="button" onclick="closeSuccessMessage()" class="hidden toastSuccessMessage fixed right-4 top-4 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition-all transition duration-300 hover:bg-green-600">
        <div class="flex items-center space-x-2">
            <span class="text-3xl"><i class="fa-solid fa-check mr-2"></i></span>
            <p class="font-bold successMessage"></p>
        </div>
    </button>