@extends('layouts.home')

@section('title', 'Accueil')

@section('body')
    <div class="bg-teal-400 flex flex-col">
        @include('partials.home.nav-bar')

        @include('partials.home.presentation')

        <div class="rounded-big border border-teal-400 absolute rounded-full"></div>
        <div class="rounded-small border border-teal-400 absolute rounded-full"></div>

        @include('partials.home.merchants')

        <livewire:components.home-newsletter />

        <div class="bg-white flex space-x-4 w-full pt-4 pb-4 mb-24">
            <div class="w-1/12"></div>
            <div class="flex leading-tight w-9/12 bg-yellow-400 rounded space-x-3">
                <div class="w-6/12">
                    <div class="border-b border-white mx-6 py-6 text-black text-lg">Payer chez tous les marchands partenaire en toute securite</div>
                    <div class="border-b border-white mx-6 py-6 text-black text-lg">Garder l'historique complet de vos transactions</div>
                    <div class="border-b border-white mx-6 py-6 text-black text-lg">Details de tous vos paiements avec des informations detaillees</div>
                    <div class="border-b border-white mx-6 py-6 text-black text-lg">Ne subissez aucun frais de paiement</div>
                </div>
                <div class="w-6/12 border-l border-white p-4">right</div>
            </div>
            <div class="w-1/12"></div>
        </div>

    </div>
@endsection