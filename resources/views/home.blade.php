@extends('layouts.app')

@section('content')
    <v-box
        :chart-data="{{ json_encode($result->data) }}"
        module-title="Dashboard"
        :col-headers="{{ json_encode([]) }}"
        :record="{{ json_encode([])}}"
        module-id="dashboard"
    ></v-box>
@endsection

@section('modals');

@endsection

@section('scripts');

@endsection
