@extends('layouts.app')

@section('content')
<login-card
    login="{{ route('login') }}"
    token="{{ csrf_token() }}"
    register="{{ url('/register') }}"
    password="{{ route('password.request') }}"
    ></login-card>
@endsection
