@extends('layouts.home')

@section('title', trans('home.home-title'))

@section('body')
    <div x-data="HOME_INDEX_DATA()" x-cloak class="flex min-h-screen">
        <div class="flex flex-col w-6/12 bg-white px-10">
            <div class="flex flex-col leading-tight py-8">
                <h3 class="font-bold text-pblue text-2xl">Ryok</h3>
                <span class="mt-2 text-sm w-10/12 text-black-900 font-medium">
                    @lang('home.description')
                </span>
            </div>

            <div class="pt-16">
                <span class="text-4xl font-medium">@lang('home.focused-actor-merchands')</span>
                <div class="flex mt-2">
                    
                    <div class="flex-1 pr-16">
                        <h3 class="border-b pb-1 font-light">@lang('home.focused-actor-merchands')</h3>
                        <div class="flex flex-wrap">
                            <button x-on:click="setSection('create-app')" :class="{ 'text-blue-600': isSectionActive('create-app') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-submit')</button>
                            <button x-on:click="setSection('integration')" :class="{ 'text-blue-600': isSectionActive('integration') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-integration')</button>
                            <button x-on:click="setSection('transactions')" :class="{ 'text-blue-600': isSectionActive('transactions') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-transactions')</button>
                            <button x-on:click="setSection('mobile-money')" :class="{ 'text-blue-600': isSectionActive('mobile-money') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-mobile-money')</button>
                            <button x-on:click="setSection('cashout')" :class="{ 'text-blue-600': isSectionActive('cashout') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-cashout')</button>
                            <button x-on:click="setSection('b2b')" :class="{ 'text-blue-600': isSectionActive('b2b') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-b-to')</button>
                            <button x-on:click="setSection('taux')" :class="{ 'text-blue-600': isSectionActive('taux') }" class="w-6/12 flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.merchand-taux')</button> 
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="border-b pb-1 font-light">@lang('home.focused-actor-clients')</h3>
                        <div class="flex flex-col items-start">
                            <button x-on:click="setSection('qr-code')" :class="{ 'text-blue-600': isSectionActive('qr-code') }" class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.client-payment')</button>
                            <button x-on:click="setSection('history')" :class="{ 'text-blue-600': isSectionActive('history') }" class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.client-history')</button>
                            <button x-on:click="setSection('securite')" :class="{ 'text-blue-600': isSectionActive('securite') }" class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.client-security')</button>
                            <button x-on:click="setSection('bonus')" :class="{ 'text-blue-600': isSectionActive('bonus') }" class="flex mt-3 font-medium focus:outline-none hover:text-blue-600">@lang('home.client-bonus')</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 leading-tight">
                <h3 class="text-pindigo-dark font-medium underline text-lg">@lang('home.newsletter-title')</h3>
                <h3 class="w-9/12">
                    @lang('home.newsletter-description')
                </h3>
                <div class="flex mt-2">
                <input placeholder="@lang('home.newsletter-placeholder')" type="text" class="border-l border-t border-b h-10 px-2 w-6/12 rounded-l border-black">
                <button class="border border-pindigo bg-pindigo text-white flex h-10 items-center justify-center px-6 rounded-r">@lang('home.newsletter-button')</button>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col bg-gradient-to-b from-pindigo to-pindigo-dark w-7/12">
            
            <!-- create-app -->
            <div
                x-show="isSectionActive('create-app')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center rounded p-12 h-full select-none">
                <img class="w-7/12 h-64" src="{{ asset('images/create_app.png') }}" alt="">

                <div class="self-end w-6/12 relative mt-16">
                    <img class="h-24 absolute  left-0 -ml-32 top-0 -mt-16" src="{{ asset('images/create_app_arrow.png') }}" alt="">
                    <h3 class="text-center text-white text-xl leading-tight font-medium italic">
                        @lang('home.details-create-app')
                    </h3>
                </div>
            </div>

            <!-- transactions -->
            <div
                x-show="isSectionActive('transactions')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-8/12 h-64" src="{{ asset('images/transactions.png') }}" alt="">

                <h3 class="w-8/12 text-center text-white text-xl leading-tight font-medium italic">
                    @lang('home.details-transactions')
                </h3>
            </div>

            <!-- integration -->
            <div 
                x-show="isSectionActive('integration')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-8/12 h-64" src="{{ asset('images/integration.png') }}" alt="">

                <h3 class="w-8/12 text-center text-white text-xl leading-tight font-medium italic">
                    @lang('home.details-integration')
                </h3>
            </div>

            <!-- qr code -->
            <div 
                x-show="isSectionActive('qr-code')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-5/12 h-64" src="{{ asset('images/qr_code.png') }}" alt="">

                <div class="w-8/12 .border self-start w-6/12 relative mt-16">
                    <img class="h-24 absolute right-0 -mt-16 mr-16" src="{{ asset('images/qr_code_arrow.png') }}" alt="">
                    <h3 class="text-center text-white text-lg leading-tight font-medium italic">
                        @lang('home.details-qrcode')
                    </h3>
                </div>
            </div>

            <!-- history -->
            <div 
                x-show="isSectionActive('history')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center items-center rounded p-12 h-full select-none">
                <img class="w-5/12 h-64" src="{{ asset('images/history.png') }}" alt="">

                <div class="w-8/12 .border self-start w-6/12 relative mt-16">
                    <img class="h-24 absolute right-0 -mt-16 mr-16" src="{{ asset('images/qr_code_arrow.png') }}" alt="">
                    <h3 class="text-center text-white text-lg leading-tight font-medium italic">
                    </h3>
                </div>
            </div>

            <!-- securite -->
            <div 
                x-show="isSectionActive('securite')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center rounded p-12 h-full select-none">
                <img class="w-5/12 h-64" src="{{ asset('images/securite.png') }}" alt="">

                <div class="w-8/12 .border self-start w-6/12 relative mt-16">
                    <img class="h-24 absolute right-0 -mt-16 mr-16" src="{{ asset('images/create_app_arrow.png') }}" alt="">
                    <h3 class="text-center text-white text-lg leading-tight font-medium italic">
                    
                    </h3>
                </div>
            </div>

            <!-- taux -->
            <div 
                x-show="isSectionActive('taux')"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex flex-col bg-green justify-center rounded p-12 h-full select-none items-center justify-center">
                
                <div class="flex flex-col bg-white rounded p-8 shadow-lg">
                    <span class="underline text-xl">@lang('home.details-taux-title')</span>
                    <div>
                        <span class="font-bold text-5xl">1% + 100 Fcfa</span>
                    </div>
                </div>
                
            </div>
        
        </div>


        <script>
            function HOME_INDEX_DATA() {
                return {
                    section: 'create-app',
                    setSection(active) {
                        this.section = active;
                    },
                    isSectionActive(active) {
                        return this.section == active
                    },
                }
            }
        </script>

    </div>
@endsection