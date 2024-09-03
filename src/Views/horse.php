<?php
require_once __DIR__ . '/Includes/Button.php';

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>
<section class="bg-[url('https://images.unsplash.com/photo-1599471921533-551b97dbda13?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class="text-8xl text-center py-48 w-2/3 m-auto font-bold textShadow" style='font-family: "Amatic SC", sans-serif;'>La cavalerie</h1>
</section>


<div class="divCardsSite columns-1 sm:columns-2 md:columns-3 xl:columns-4 gap-7 p-6">

</div>

<?php
include __DIR__ . '/Includes/footer.php'
?>
<script>
    getAllHorsesSite();
</script>