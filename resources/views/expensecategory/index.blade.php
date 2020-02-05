@extends('layouts.app')

@section('content')
    <v-box
        module-title="Expense Category"
        :col-headers="{{ json_encode(['ID', 'Display Name', 'Description', 'Created at']) }}"
        :record="{{ json_encode(['id' => '', 'name' => '', 'description' => ''])}}"
        module-id="expensecategory"
    ></v-box>
@endsection

@section('modals');

@endsection

@section('scripts');

@endsection
