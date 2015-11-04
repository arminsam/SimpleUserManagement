@extends('layouts.admin.dashboard')

@section('content')

    @include('components.breadcrumb.index')

    <div class="row">

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Role Details</h3>
                </div>
                <div class="panel-body panel-collapse collapse in">

                    <div class="row space-top5 space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Name :</strong></div>
                        <div class="col-sm-8">{{ $role->name }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>No. of Users :</strong></div>
                        <div class="col-sm-8">{{ $role->present()->users() }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Created At :</strong></div>
                        <div class="col-sm-8">{{ $role->created_at->format('Y/m/d H:i:s') }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Last Updated At :</strong></div>
                        <div class="col-sm-8">{{ $role->updated_at->format('Y/m/d H:i:s') }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Capabilities :</strong></div>
                        <div class="col-sm-8">{{ $role->present()->capabilities() }}</div>
                    </div>

                    <hr>

                    <div class="row space-top20 space-btm5">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-default" onclick="window.history.back();"><i class="fa fa-fw fa-arrow-left"></i> Back</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Actions</h3>
                </div>
                <div class="panel-body">
                    {{ $role->present()->editButton() }}
                    {{ $role->present()->deleteButton() }}
                    {{ $role->present()->defaultMessage() }}
                </div>
            </div>
        </div>

    </div>
@stop
