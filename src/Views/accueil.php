<?php
require_once __DIR__ . '/Includes/Button.php';

$bouton = new Button('Découvrir', '#');
$boutonContact = new Button('Nous contacter', '#');

include __DIR__ . '/Includes/headerWebsite.php';
?>

<section class="bg-[url('https://images.pexels.com/photos/2325007/pexels-photo-2325007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] h-screen bg-cover bg-center relative">
    <?php
    include __DIR__ . '/Includes/navBarre.php';

    ?>

    <h1 class="text-4xl text-center my-24 w-2/3 m-auto">Centre équestre du ipsum dolor</h1>
    <p class="text-2xl text-center my-24 w-2/3 m-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque natus minima doloremque quam similique voluptatibus voluptatum recusandae at vero, non ipsam laudantium ut perspiciatis dolore, quo dolorem nesciunt error rem?</p>

    <div class="w-fit text-2xl m-auto absolute bottom-2 left-[45%]">
        <?= $bouton->create_a() ?>
    </div>
</section>

<section class="bg-[#C0DF85]">
    <div class="bg-cover w-full flex justify-center items-center">
        <div class="w-full backdrop-filter backdrop-blur-lg">
            <div class="w-11/12 mx-auto rounded-2xl  p-5 backdrop-filter backdrop-blur-lg">

                <div class="divCartes grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-2 mx-auto">
                    <article class="bg-white  p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
                        <a href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></a>
                        <div class="relative mb-4 rounded-2xl">
                            <img class="max-h-44 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105" src="https://images.pexels.com/photos/2325007/pexels-photo-2325007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">


                            <a class="flex justify-center items-center bg-[#FF9029] bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100" href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" rel="noopener noreferrer">
                                Modifier le voyage
                                <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="flex w-full pb-4 mb-auto">
                            <p class=" font-bold text-xl group-hover:text-[#FF9029] transition-colors duration-200 ">Text</p>

                        </div>

                        <p class=' text-justify mb-4 text-base'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, aperiam. Repellat ipsam vero modi similique numquam porro unde eveniet et, nemo minus ipsa debitis deleniti vitae sunt laborum officia nesciunt.</p>

                    </article>
                    <article class="bg-white  p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
                        <a href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></a>
                        <div class="relative mb-4 rounded-2xl">
                            <img class="max-h-44 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105" src="https://images.pexels.com/photos/2325007/pexels-photo-2325007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">


                            <a class="flex justify-center items-center bg-[#FF9029] bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100" href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" rel="noopener noreferrer">
                                Modifier le voyage
                                <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="flex w-full pb-4 mb-auto">
                            <p class=" font-bold text-xl group-hover:text-[#FF9029] transition-colors duration-200 ">Text</p>

                        </div>

                        <p class=' text-justify mb-4 text-base'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, aperiam. Repellat ipsam vero modi similique numquam porro unde eveniet et, nemo minus ipsa debitis deleniti vitae sunt laborum officia nesciunt.</p>

                    </article>
                    <article class="bg-white  p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
                        <a href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></a>
                        <div class="relative mb-4 rounded-2xl">
                            <img class="max-h-44 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105" src="https://images.pexels.com/photos/2325007/pexels-photo-2325007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">


                            <a class="flex justify-center items-center bg-[#FF9029] bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100" href="{{ path('app_adv_voyage_edit', {'id': adv_voyage.id}) }}" target="_self" rel="noopener noreferrer">
                                Modifier le voyage
                                <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="flex w-full pb-4 mb-auto">
                            <p class=" font-bold text-xl group-hover:text-[#FF9029] transition-colors duration-200 ">Text</p>

                        </div>

                        <p class=' text-justify mb-4 text-base'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, aperiam. Repellat ipsam vero modi similique numquam porro unde eveniet et, nemo minus ipsa debitis deleniti vitae sunt laborum officia nesciunt.</p>

                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="m-10">
    <h2 class="text-3xl">Prochainement</h2>
    <div class="flex justify-around ">
        <div class="w-1/2 p-6 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, consequuntur doloremque! Nostrum rerum facere labore, velit quis voluptates exercitationem commodi assumenda doloremque dolore architecto quam minima dolores ipsa quidem aspernatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, nisi id quo nulla aperiam eum harum iure ipsa deleniti, at necessitatibus, repudiandae eaque error quidem dolores illo sit velit quibusdam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, explicabo quam veniam, eaque, sit ipsum voluptate deserunt molestias dignissimos quos non a nemo. Exercitationem distinctio beatae nobis dolore laboriosam perspiciatis!</div>
        <img src="https://cdn.pixabay.com/photo/2016/11/08/16/03/horse-1808727_1280.jpg" alt="" class="w-1/2 p-6">
    </div>
</section>

<section class="m-10 flex justify-around items-center">
    <img src="https://images.unsplash.com/photo-1624125278860-381b6acd3b44?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="w-2/5 p-6">
    <div class="w-3/5 p-6 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, consequuntur doloremque! Nostrum rerum facere labore, velit quis voluptates exercitationem commodi assumenda doloremque dolore architecto quam minima dolores ipsa quidem aspernatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, nisi id quo nulla aperiam eum harum iure ipsa deleniti, at necessitatibus, repudiandae eaque error quidem dolores illo sit velit quibusdam. <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, explicabo quam veniam, eaque, sit ipsum voluptate deserunt molestias dignissimos quos non a nemo. Exercitationem distinctio beatae nobis dolore laboriosam perspiciatis! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat excepturi amet qui sint aliquid sunt atque inventore veritatis et in quia voluptas praesentium, alias quas quos fuga ullam veniam numquam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut quasi rerum facilis repudiandae nisi voluptate recusandae? Voluptatem adipisci eligendi obcaecati placeat, ipsum neque corrupti a inventore nostrum eveniet facere deserunt.</div>
</section>

<div class="w-fit text-2xl m-auto mb-10">
    <?= $boutonContact->create_a() ?>
</div>

<?php
include __DIR__ . '/Includes/footer.php'
?>