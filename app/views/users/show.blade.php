@extends('layouts.admin.dashboard')

@section('content')

    @include('components.breadcrumb.index')

    <div class="row">

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">User Profile</h3>
                </div>
                <div class="panel-body panel-collapse collapse in">

                    <div class="row space-top5 space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Name :</strong></div>
                        <div class="col-sm-8">{{ $user->name }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Email :</strong></div>
                        <div class="col-sm-8">{{ $user->email }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Username :</strong></div>
                        <div class="col-sm-8">{{ $user->username }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Roles :</strong></div>
                        <div class="col-sm-8">{{ $user->present()->userRoles() }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Registered At :</strong></div>
                        <div class="col-sm-8">{{ $user->created_at->format('Y/m/d H:i:s') }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Last Updated At :</strong></div>
                        <div class="col-sm-8">{{ $user->updated_at->format('Y/m/d H:i:s') }}</div>
                    </div>

                    <div class="row space-btm20">
                        <div class="col-sm-4 text-right text-left-sm"><strong>Deleted At :</strong></div>
                        <div class="col-sm-8">{{ $user->deleted_at ? $user->deleted_at->format('Y/m/d H:i:s') : '-' }}</div>
                    </div>

                    <hr>

                    <div class="row space-btm5">
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
                    {{ $user->present()->editButton() }}
                    {{ $user->present()->deleteButton() }}
                    {{ $user->present()->restoreButton() }}
                    {{ $user->present()->updatePasswordButton() }}
                    {{ $user->present()->defaultMessage() }}
                </div>
            </div>
        </div>

    </div>
@stop
