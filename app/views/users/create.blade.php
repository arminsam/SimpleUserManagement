@extends('layouts.admin.dashboard')

@section('content')

    @include('components.breadcrumb.index')

    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New User</h3>
                </div>
                <div class="panel-body pdng0 pdng-top20 pdng-btm10">

                    <div class="col-md-3 col-md-push-9">
                        <div class="well well-warning">
                            <i class="fa fa-fw fa-info-circle"></i> Lorem ipsum dolor sit amet, at vidit salutatus sententiae duo.
                            Nec et vidisse tritani nusquam. Nam lorem quando eloquentiam et,
                            ludus iuvaret nec te. Has debet praesent in, cu mel lorem vitae
                            doming, te meis constituto sea. Accusam deseruisse mea ut, ubique
                            sapientem liberavisse id nec. Ne eripuit qualisque pri, ex has
                            justo vidisse comprehensam.
                        </div>
                    </div>

                    <div class="col-md-9 col-md-pull-3">

                        {{ Form::open(['url' => route('user.store', []), 'class' => 'form-horizontal']) }}

                        <!-- Email input -->
                        <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                            {{ Form::label('email', 'Email',[
                                'class' => 'col-md-4 control-label required'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('email', Input::old('email'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'User email'
                                ]) }}
                            </div>
                        </div>

                        <!-- Name input -->
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                            {{ Form::label('name', 'Name', [
                                'class' => 'col-md-4 control-label required'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('name', Input::old('name'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'User name',
                                    'data-plugin' => 'text-to-slug',
                                    'data-separator' => '.',
                                    'data-target' => '#username'
                                ]) }}
                            </div>
                        </div>

                        <!-- Username input -->
                        <div class="form-group {{ $errors->first('username') ? 'has-error' : '' }}">
                            {{ Form::label('username', 'Username', [
                                'class' => 'col-md-4 control-label required'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('username', Input::old('username'), [
                                    'id' => 'username',
                                    'class' => 'form-control',
                                    'placeholder' => 'Username'
                                ]) }}
                            </div>
                        </div>

                        <!-- Roles input -->
                        <div class="form-group {{ $errors->first('roleIds[]') ? 'has-error' : '' }}">
                            {{ Form::label('roleIds', 'Roles', [
                                'class' => 'col-md-4 control-label'
                            ]) }}
                            <div class="col-md-8">
                                <div id="roles-container" class="border1 pdng10" style="height: 150px; overflow-y: scroll;">
                                    @if ($roles->count() > 0)
                                        @foreach ($roles as $role)
                                            <div>
                                                <label class="font-normal">
                                                    {{ Form::checkbox('roleIds[]', $role->id, in_array($role->id, Input::old('roleIds') ?: [])) . ' ' . $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <i>No roles to choose from.</i>
                                    @endif
                                </div>
                                <p class="help-block">Note: A user can have <code>multiple</code> roles.</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Submit form -->
                        <div class="form-group space-top20">
                            <div class="col-md-offset-4 col-md-8">
                                <a class="btn btn-default" href="javascript:;" onclick="window.history.back();">Back</a>
                                {{ Form::button('<i class="fa fa-fw fa-check"></i> Create', [
                                    'class' => 'btn btn-success',
                                    'type' => 'submit',
                                ]) }}
                            </div>
                        </div>

                        {{ Form::close() }}

                    </div>

                </div>
            </div>
        </div>

    </div>
@stop