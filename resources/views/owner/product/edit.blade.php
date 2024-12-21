@extends('owner.layouts.app')

@section('content')
    @include('owner.product.form', ['isEdit' => true])
@endsection