@extends('layouts.public.page')

@section('content')

    <div class="row space-top45">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="well well-default">

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a class="logo" style="float: none; font-size: 30px;" href="{{ route('login.index', []) }}">
                            <span>SUMM</span>
                        </a>
                    </div>
                </div>

                {{ Form::open([
                    'url' => route('forgot.password', []),
                    'class' => 'form-horizontal space-top20',
                ]) }}

                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                    <div class="col-sm-12">
                        {{ Form::text('email', Input::old('email'), [
                            'class' => 'form-control',
                            'placeholder' => 'Email address'
                        ]) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        {{ Form::button('Send Reminder', [
                            'class' => 'form-control btn btn-primary btn-block',
                            'type' => 'submit',
                        ]) }}
                    </div>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

@stop