@extends('layouts.dash')

@section('title', trans('apps.apps-users.show.title'))

@section('body')
    <livewire:livewire-apps-users-show :appId="$appId" :userId="$userId"  />
@endsection