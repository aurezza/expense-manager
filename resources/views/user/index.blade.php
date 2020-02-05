@extends('layouts.app')

@section('content')
    <v-box
        :roles="{{ $result->data }}"
        module-title="Users"
        :col-headers="{{ json_encode(['ID', 'Name', 'Email Address', 'Role', 'Created at']) }}"
        v-bind:record="{{ json_encode(['id' => '', 'email' => '', 'role_id' => 1, 'password' => '', 'password_confirm' => ''])}}"
        module-id="user"
    ></v-box>
@endsection

@section('modals');

@endsection

@section('scripts');

@endsection
