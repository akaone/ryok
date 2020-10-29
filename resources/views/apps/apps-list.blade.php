@extends('layouts.dash')

@section('title', trans('apps.app.list.title'))

@section('body')
    <livewire:livewire-apps-list />
@endsection