@extends('layouts.home')

@section('title', trans('merchant-qr-code.title'))

@section('body')
    <livewire:livewire-merchant-qr-code-show :my-id="$id" />
@endsection
