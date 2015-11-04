@extends('layouts.public.page')

@section('content')

    <div class="row space-top45">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="well well-default">

                <div class="row space-btm20">
                    <div class="col-sm-12 text-center">
                        <a class="logo" style="float: none; font-size: 30px;" href="{{ route('login.index', []) }}">
                            <span>SUMM</span>
                        </a>
                    </div>
                </div>

                {{ Form::open([
                    'url' => route('login'),
                    'class' => 'form-horizontal space-top20',
                ]) }}

                    <div class="form-group {{ $errors->first('username') ? 'has-error' : '' }}">
                        <div class="col-sm-12">
                            {{ Form::text('username', Input::old('username'), [
                                'class' => 'form-control',
                                'placeholder' => 'Email / Username'
                            ]) }}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                        <div class="col-sm-12">
                            {{ Form::password('password', [
                                'class' => 'form-control',
                                'placeholder' => 'Password'
                            ]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{ Form::button('Login', [
                                'class' => 'form-control btn btn-primary btn-block',
                                'type' => 'submit',
                            ]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 text-center-xs">
                            <a href="{{ route('forgot.password.index', []) }}">Forgot your password?</a>
                        </div>
                    </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

@stop