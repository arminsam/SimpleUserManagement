@extends('layouts.public.page')

@section('content')

    <div class="container">

        <!-- Registration form -->
        {{ Form::open([
            'url' => route('user.store'),
            'class' => 'form-signin',
        ]) }}
        <h2 class="form-signin-heading">registration now</h2>
        @include('widgets.messages')
        <div class="login-wrap">
            <p>Enter your personal details below</p>

            {{ Form::text('email', Input::old('email'), [
                'class' => 'form-control',
                'placeholder' => 'Email'
            ]) }}

            {{ Form::text('username', Input::old('username'), [
                'class' => 'form-control',
                'placeholder' => 'Username'
            ]) }}

            {{ Form::password('password', [
                'class' => 'form-control',
                'placeholder' => 'Password'
            ]) }}

            {{ Form::password('password_confirmation', [
                'class' => 'form-control',
                'placeholder' => 'Password Confirmation'
            ]) }}


            {{ Form::button('Submit', [
                'class' => 'btn btn-lg btn-login btn-block',
                'type' => 'submit'
            ]) }}

            <div class="registration">
                Already Registered.
                <a class="" href="{{ route('login.index') }}">
                    Login
                </a>
            </div>

        </div>

        {{ Form::close() }}

    </div>

@stop
