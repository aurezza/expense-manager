@extends('layouts.app')

@section('content')
    <v-box
        :categories="{{ $result->data }}"
        :user_id={!! Auth::user()->id !!}
        module-title="Expenses"
        :col-headers="{{ json_encode(['ID', 'Category', 'Amount', 'Entry Date', 'Created at']) }}"
        :record="{{ json_encode(['id' => '', 'user_id' => Auth::user()->id, 'category_id' => 1, 'amount' => '', 'entry_date' => ''])}}"
        module-id="expense"
    ></v-box>
@endsection

@section('modals');

@endsection

@section('scripts');

@endsection
