@extends('layouts.admin.dashboard')

@section('content')

    @include('components.breadcrumb.index')

    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New Role</h3>
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

                        {{ Form::open(['url' => route('role.store', []), 'class' => 'form-horizontal']) }}

                        <!-- Name input -->
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                            {{ Form::label('name', 'Name', [
                                'class' => 'col-md-4 control-label required'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('name', Input::old('name'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Role name'
                                ]) }}
                            </div>
                        </div>

                        <!-- Capabilities input -->
                        <div class="form-group {{ $errors->first('capabilities[]') ? 'has-error' : '' }}">
                            {{ Form::label('capabilities[]', 'Capabilities', [
                                'class' => 'col-md-4 control-label'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::chooseCapabilities('capabilities[]', Input::old('capabilities[]')) }}
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

    @section('scripts')
        @parent
        @include('scripts.create_roles')
    @stop
@stop