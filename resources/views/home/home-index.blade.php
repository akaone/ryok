@extends('layouts.home')

@section('title', 'Accueil')

@section('body')
    <div x-data="HOME_INDEX_DATA()" class="flex min-h-screen">
        <div class="flex flex-col w-6/12 bg-white px-10">
            <div class="flex flex-col leading-tight py-8">
                <h3 class="font-bold text-pblue text-2xl">Ryok</h3>
                <span class="mt-2 text-sm w-10/12 text-black-900 font-medium">
                    Une plateforme qui vous permet d'accepter et d'effectuer des e-payments mobile money.
                </span>
            </div>

            <div class="pt-16">
                <span class="text-4xl font-medium">Machands</span>
                <div class="flex mt-2">
                    
                    <div class="flex-1 pr-16">
                        <h3 class="border-b pb-1 font-light">Marchands</h3>
                        <div class="flex flex-wrap">
                            <button x-on:click="setSection('create-app')" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Soumission</button>
                            <button x-on:click="setSection('integration')" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Integration</button>
                            <button x-on:click="setSection('transactions')" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Transactions</button>
                            <button class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Mobile money</button>
                            <button class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Cashout</button>
                            <button class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">B2C & B2B</button>
                            <button class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">Taux</button> 
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="border-b pb-1 font-light">Acheteurs</h3>
                        <div class="flex flex-col items-start">
                            <button class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">Paiements</button>
                            <button class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">Historique</button>
                            <button class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">Securite</button>
                            <button class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">Bonus</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 leading-tight">
                <h3 class="text-pindigo-dark font-medium underline text-lg">Newsletter</h3>
                <h3 class="w-9/12">
                    Reserver votre place pour compter parmi les premiers selectionnes au lancement
                </h3>
                <div class="flex mt-2">
                <input placeholder="Entrez votre adresse email" type="text" class="border-l border-t border-b h-10 px-2 w-6/12 rounded-l border-black">
                <button class="border border-pindigo bg-pindigo text-white flex h-10 items-center justify-center px-6 rounded-r">S'abonner</button>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col bg-gradient-to-b from-pindigo to-pindigo-dark w-7/12">

        <div x-show="section == 'create-app'" class="flex flex-col bg-green justify-center rounded p-12 h-full select-none">
                <img class="w-7/12 h-64" src="{{ asset('images/create_app.png') }}" alt="">

                <div class="self-end w-6/12 relative mt-16">
                    <img class="h-24 absolute  left-0 -ml-32 top-0 -mt-16" src="{{ asset('images/create_app_arrow.png') }}" alt="">
                    <h3 class="text-center text-white text-xl leading-tight font-medium italic">
                        Creer une app pour chacun de vos projets et commencer a recevoir des paiements de vos clients.
                    </h3>
                </div>
            </div>

            <div x-show="section == 'transactions'" class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-8/12 h-64" src="{{ asset('images/transactions.png') }}" alt="">

                <h3 class="w-8/12 text-center text-white text-xl leading-tight font-medium italic">
                    Gardez un oeil sur toutes les transactions et paiements effectues sur vos applications en temps reels.
                </h3>
            </div>

            <div x-show="section == 'integration'" class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-8/12 h-64" src="{{ asset('images/integration.png') }}" alt="">

                <h3 class="w-8/12 text-center text-white text-xl leading-tight font-medium italic">
                    Integrez en un rien de temps notre module de paiement dans vos applications avec une documentation claire et simple.
                </h3>
            </div>
        
        </div>


        <script>
    function HOME_INDEX_DATA() {
        return {
            section: 'create-app',
            setSection(active) {
                this.section = active;
            },
        }
    }
</script>

    </div>
@endsection