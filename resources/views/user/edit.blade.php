@extends('layouts.app')

@section('content')
    <v-box
        module-title="My Account"
        :record="{{ json_encode($user) }}"
        module-id="account"
    ></v-box>
@endsection

@section('modals');

@endsection

@section('scripts');

@endsection
