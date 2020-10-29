@extends('layouts.dash')

@section('title', trans('apps.app.show.title'))

@section('body')
    <livewire:livewire-app-show :appId="$appId" />
@endsection