@extends('web.layouts.default', ['page' => 'detail'])

@section('page_name', 'detail')

@section('meta')
<title>{{ config('app.name') }}</title>
<meta name="title" content="{{ config('app.name') }}">
@endsection

@section('content')
<section>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Accueil</a></li>
            <li>Faites-moi courir</li>
        </ul>
        <div class="grid lg:grid-cols-11 grid-cols-none gap-10">
            <div class="lg:col-span-8 col-span-auto">
                <div
                    class="shadow py-5 lg:p-10 w-full h-44 lg:h-full rounded-lg bg-center bg-no-repeat bg-cover relative"
                    style="background-image: url({{ asset('/images/dynamic/card_bg.jpg') }})"
                >
                    <div class="lg:absolute lg:top-10 lg:right-10 clock-container bg-white">
                        <div class="clock-col">
                            <p class="clock-timer">06</p>
                            <p class="clock-label clock-days">Jours</p>
                        </div>
                        <div class="clock-col">
                            <p class="clock-timer">04</p>
                            <p class="clock-label clock-hours">Heures</p>
                        </div>
                        <div class="clock-col">
                            <p class="clock-timer">26</p>
                            <p class="clock-label clock-minutes">Minutes</p>
                        </div>
                        <div class="clock-col">
                            <p class="clock-timer">39</p>
                            <p class="clock-label clock-seconds">Secondes</p>
                        </div>
                    </div>
                    <div class="hidden lg:flex absolute bottom-10 left-10 author-info items-center">
                        <div class="author-avatar mr-5">
                            <img src="{{ asset('images/statics/avatar-placeholder.svg') }}" width="80" />
                        </div>
                        <div class="flex flex-col author-detail">
                            <span class="text-2xl text-white font-black">Faites-moi courir</span>
                            <span class="text-white text-sm">Par Claude de Koh-Lanta</span>
                            <ul class="text-yellow-500 text-xs">
                                <li class="float-left mr-2.5">#AllezlesChampions</li>
                                <li class="float-left">#AllezlesChampions</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="lg:hidden block author-info flex-col flex items-center mt-8">
                    <div class="author-avatar mb-3">
                        <img src="{{ asset('images/statics/avatar-placeholder.svg') }}" width="80" />
                    </div>
                    <div class="flex flex-col items-center author-detail">
                        <span class="text-2xl font-black">Faites-moi courir</span>
                        <span class="text-sm mb-1">Par <b>Claude de Koh-Lanta</b></span>
                        <ul class="text-primary text-xs">
                            <li class="float-left mr-2.5">#AllezlesChampions</li>
                            <li class="float-left">#AllezlesChampions</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 col-span-auto flex flex-col rounded-lg border p-5">
                <h2 class="font-black text-2xl mb-5">Engagement</h2>
                <span class="bg-yellow-300 p-3 rounded-lg font-bold text-sm mb-2">
                    10€ données  =  1 km
                </span>
                <div class="text-sm flex items-center my-2">
                    <img class="mr-3" src="{{ asset('/images/icons/ic-smile.svg') }}" />
                    <span>2500 € recoltes</span>
                </div>
                <div class="text-sm flex items-center my-2">
                    <img class="mr-3" src="{{ asset('/images/icons/ic-smile.svg') }}" />
                    <span>187 donateurs</span>
                </div>
                <div class="text-sm flex items-center my-2">
                    <img class="mr-3" src="{{ asset('/images/icons/ic-smile.svg') }}" />
                    <span>500 km</span>
                </div>
                <div class="py-5 -mx-5 border-t px-5">
                    <button class="uppercase text-sm inline-flex items-center justify-between bg-primary text-white font-bold py-2 px-4 border border-primary rounded-lg w-full">
                        Je Participe !
                        <img src="{{ asset('images/icons/ic-arrow.svg') }}" class="ml-2" alt="arrow-icon" />
                    </button>
                </div>
                <div class="pt-5 -mx-5 border-t px-5">
                    <button class="uppercase text-left text-sm bg-white hover:bg-gray-100 border font-bold py-2 px-4 rounded-lg w-full">
                        Je Partage
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="grid lg:grid-cols-11 grid-cols-none gap-10">
            <div class="lg:col-span-8 col-span-auto">
                <div class="border-b py-10 lg:py-20">
                    <h2 class="text-2xl font-black mb-5">Le mot de Claude</h2>
                    <p class="text-sm">
                    Pour aider nos champions je m’engage à réaliser un challenge de squats ! Chaque don réalisé augmentera le nombre de squats à faire : 1 squat par don de 5 €.
                    Tous les bénéfices seront versés à l’association Aîda dont je suis marraine afin de lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis arcu aliquet auctor accumsan in risus.
                    Nisl, mi vulputate blandit in duis mi quis. Phasellus turpis elit in luctus sapien risus ...</p>
                </div>
                <div class="border-b py-10 lg:py-20">
                    <div class="flex justify-between items-center mb-10">
                        <h2 class="text-2xl font-black">Les dernières actus</h2>
                        <button class="hidden lg:block uppercase text-left text-sm bg-white hover:bg-gray-100 border font-bold py-2 px-5 rounded-lg">
                            Me tenir au courant
                        </button>
                    </div>
                    <div class="grid lg:grid-cols-3 gird-cols-none gap-10">
                        <div class="">
                            <div class="p-5 rounded-lg border">
                                <div class="flex mb-5">
                                    <img class="inline-block h-10 w-10 mr-5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="flex flex-col text-sm">
                                        <span class="font-bold w-full">Claude Koh-Lanta</span>
                                        <span class="w-full">19 Mars 2021</span>
                                    </div>
                                </div>
                                <h3 class="text-base font-bold mb-2.5">Je ne serai pas seul !</h3>
                                <p class="text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus turpis, eu sagittis neque sollicitudin sit amet. Proin tincidunt lorem et sem efficitur molestie. Donec a tempor massa. Nam vel dui faucibus, sollicitudin odio eu, rutrum sapien. Cras vitae mauris in leo congue ornare. Mauris posuere aliquet sem pellentesque tincidunt.
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <div class="rounded-lg border p-5">
                                <div class="flex mb-5">
                                    <img class="inline-block h-10 w-10 mr-5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="flex flex-col text-sm">
                                        <span class="font-bold w-full">Claude Koh-Lanta</span>
                                        <span class="w-full">19 Mars 2021</span>
                                    </div>
                                </div>
                                <h3 class="text-base font-bold mb-2.5">Je ne serai pas seul !</h3>
                                <p class="text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus turpis, eu sagittis neque sollicitudin sit amet.
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <div class="rounded-lg border p-5">
                                <div class="flex mb-5">
                                    <img class="inline-block h-10 w-10 mr-5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="flex flex-col text-sm">
                                        <span class="font-bold w-full">Claude Koh-Lanta</span>
                                        <span class="w-full">19 Mars 2021</span>
                                    </div>
                                </div>
                                <h3 class="text-base font-bold mb-2.5">L’entrainement le plus difficile</h3>
                            </div>
                        </div>
                        <div>
                            <button class="uppercase text-left text-sm bg-white hover:bg-gray-100 border font-bold py-2 px-5 rounded-lg">
                                Voir plus d'actualités
                            </button>
                        </div>
                    </div>
                </div>
                <div class="py-10 lg:py-20">
                    <div class="flex lg:flex-nowrap flex-wrap">
                        <img class="rounded-lg lg:mr-10 mx-auto mb-5 lg:mb-0" src="{{ asset('images/dynamic/card_bg.jpg') }}" width="360" />
                        <div class="">
                            <h2 class="text-2xl font-black mb-2.5">Qui sont nos champions ?</h2>
                            <p class="text-sm mb-5">L’association Aida s’engage à aider tous les jeunes qui combattent tous les jours à l’hôpital. 
                            C’est à notre tour relever des défis sportifs de dépassement de soi pour pouvoir les aider.
                            Elle réalise des visites quotidiennes à l’hôpital et accompagne ainsi près de 2000 patients dans 35 services et 15 villes de France.
                            </p>
                            <button
                                class="uppercase text-sm inline-flex items-center justify-between bg-primary text-white font-bold py-2 px-4 border border-primary rounded-lg"
                            >
                                En savoir plus
                                <img src="{{ asset('images/icons/ic-arrow.svg') }}" class="ml-2" alt="arrow-icon" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 col-span-auto">
                <div class="pb-10 pt-24">
                    <h2 class="text-2xl font-black mb-2">Tirage au sort</h2>
                    <p class="text-sm">
                        A la fin du challenge, une personne sera tirée au sort parmi les donateurs
                        A gagner : Une rencontre avec Claude !
                    </p>
                </div>
                <div class="rounded-lg p-5 border">
                    <h2 class="text-2xl font-black mb-5">Supporters</h2>
                    <ul>
                        <li class="py-5 border-b">
                            <div class="flex items-center mb-2.5">
                                <img class="inline-block h-10 w-10 mr-2.5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold">Louise</span>
                                    <span class="text-sm text-primary font-bold">50 €</span>
                                </div>
                            </div>
                            <p class="text-sm">Super idée cette opération ! Je suis tellement à fond avec vous :)</p>
                        </li>
                        <li class="py-5 border-b">
                            <div class="flex items-center mb-2.5">
                                <img class="inline-block h-10 w-10 mr-2.5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold">Anonyme</span>
                                    <span class="text-sm text-primary font-bold">20 €</span>
                                </div>
                            </div>
                            <p class="text-sm">Vous êtes les meilleurs</p>
                        </li>
                        <li class="py-5 border-b">
                            <div class="flex items-center">
                                <img class="inline-block h-10 w-10 mr-2.5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold">Pierre</span>
                                    <span class="text-sm text-primary font-bold">5 €</span>
                                </div>
                            </div>
                        </li>
                        <li class="pt-5">
                            <div class="flex items-center">
                                <img class="inline-block h-10 w-10 mr-2.5 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold">Fred</span>
                                    <span class="text-sm text-primary font-bold">5 €</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection