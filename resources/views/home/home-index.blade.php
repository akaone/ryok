@extends('layouts.home')

@section('title', 'Accueil')

@section('body')
    <div class="bg-white flex flex-col">
        <!-- START NAVBAR -->
        <div class="bg-white border-b w-full sticky top-0">
            <div class="container py-4 flex flex-col md:flex-row md:items-center mx-4 md:mx-auto">
            <div class="w-1/6">
                <h3 class="font-ryok text-pblue text-2xl">Ryok</h3>
            </div>
            <div class="w-4/6 hidden md:block">
                <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Opérateurs</a>
                <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Fonctionnalités</a>
                <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Developpeurs & Entreprises</a>
                <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Faq</a>
            </div>
            <a href="{{ route('login') }}" class=" bg-pblue px-2 py-2 rounded-full shadow hover:shadow-lg">
                <div class="font-medium text-white text-xs">
                Accés marchand
                </div>
            </a>
            </div>
        </div>
        <!-- END NAVBAR -->
        <div class="bg-gray-200 w-full">

            <!-- START PRESENTATION -->
            <div class="container mx-4 md:mx-auto flex flex-col md:flex-row">
                <div class="w-full md:w-7/12 mt-16 mb-4">
                <span class="font-lato text-2xl md:text-4xl italic font-bold leading-tight">
                    Traquez tout votre historique de transfert mobile money et accepter les paiements de manière sécurisé et  retracable
                </span>
                <a href="#">
                    <img src="/images/google_button.png" class="-ml-2 w-5/12 md:w-4/12">
                </a>
                </div>
                <div class="flex flex-col w-5/12 items-center mt-8 mb-6 self-end">
                <img src="/images/app_accueil.png" alt="app acceuil image" class="w-1/2 shadow-lg">
                <div class="mt-2 h-5 w-12 bg-white rounded-full shadow-md"></div>
                </div>
            </div>
            <!-- END PRESENTATION -->

        </div>

    </div>
@endsection