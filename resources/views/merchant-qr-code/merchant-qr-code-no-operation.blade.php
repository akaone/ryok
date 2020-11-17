@extends('layouts.home')

@section('title', trans('merchant-qr-code.title'))

@section('body')
    <div class="min-h-screen bg-gray-ef flex items-center justify-center">

        <div
            id="container"
            class="flex flex-col bg-white rounded-lg px-6 py-6 items-center"
            style="width: 360px;">

            <span>No ressource found</span>

        </div>

    </div>

@endsection
