<?php
require_once __DIR__ . '/Includes/Button.php';

// $boutonSend = new Button('Envoyer', 'sendContactVerification()');
// $boutonContact = new Button('Nous contacter', '#');

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>
<section class="bg-[url('https://images.unsplash.com/photo-1599471921533-551b97dbda13?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class=" text-5xl text-center py-56 w-2/3 m-auto">La cavalerie</h1>
</section>

<!--<div class="bg-cover w-full flex justify-center items-center">
    <div class="w-full backdrop-filter backdrop-blur-lg">
        <div class="w-full mx-auto rounded-2xl backdrop-filter px-2 backdrop-blur-lg">

            <div class="divCardsSite grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 m-20">

            </div>
        </div>
    </div>
</div>-->


<div class="divCardsSite columns-1 sm:columns-2 md:columns-3 xl:columns-4 gap-7 p-6">
    <div class=" break-inside-avoid mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031162.jpg" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031232.jpg" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031357.jpg" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031375.jpg" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031396.jpg" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
    </div>
    <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
    </div>
</div>

<?php
include __DIR__ . '/Includes/footer.php'
?>