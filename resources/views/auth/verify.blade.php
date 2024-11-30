<!-- resources/views/auth/verify.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <h3>{{ __('Please verify your email address.') }}</h3>
        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('Resend verification email') }}</button>
        </form>
    </div>
@endsection
