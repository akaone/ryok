@extends('layouts.home')

@section('title', trans('acl.no-access'))

@section('body')
    <div class="bg-gray-200 h-screen">

        <div class="flex flex-col items-start bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded">
            <div class='pt-6 pb-2'>
                <span class="text-lg text-pblue">{{trans('acl.no-access')}}</span>
            </div>

            <span class="text-lg">{{trans('acl.no-line-one')}}</span>
            <span class="text-lg">{{trans('acl.no-line-two')}}</span>
            <a href="#">
                <button class="flex items-center rounded bg-blue-600 hover:bg-blue-800 py-2 px-8 text-white my-4">
                    <x-heroicon-s-arrow-left class="w-4 h-4 mr-2"/>
                    <span>{{trans('acl.goback')}}</span>
                </button>
            </a>

        </div>
    </div>
@endsection