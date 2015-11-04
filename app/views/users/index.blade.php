@extends('layouts.admin.dashboard')

@section('content')

    @include('components.breadcrumb.index')

    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default data-table">
                <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-collapse collapse in">

                    @include('components.datatable.index')

                </div>
            </div>
        </div>

    </div>
@stop
