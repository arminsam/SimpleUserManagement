<form class="form-inline data-table-form" action="" method="POST">

    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" name="page" value="{{ Input::get('page') ?: '1' }}" />
    <input type="hidden" name="sort" value="{{ Input::get('sort') ?: '' }}" />
    <input type="hidden" name="order" value="{{ Input::get('order') ?: '' }}" />
    <div class="panel-body border-btm1 pdng-left10 pdng-right10">
        <div class="row actions">
            {{-- number of rows per page --}}
            <div class="col-sm-2">
                <select class="form-control space-btm5-sm" name="limit">
                    <option value="10" {{ Input::get('limit') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ Input::get('limit') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ Input::get('limit') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ Input::get('limit') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <span class="loader"><i class="fa fa-gear fa-spin"></i></span>
            </div>
            <div class="col-sm-10 text-right text-center-sm">
                {{-- add a new record --}}
                @if (isset($dataTable->actions['global']['create']) && (empty($dataTable->actions['global']['create']['capability']) || user_can($dataTable->actions['global']['create']['capability'])))
                    <a href="{{ $dataTable->actions['global']['create']['route'] }}" class="btn btn-success btn-add" data-toggle="tooltip" title="Add a New Record"><i class="fa fa-plus"></i></a>
                @endif

                {{-- delete selected row(s) --}}
                @if (isset($dataTable->actions['global']['delete']) && (empty($dataTable->actions['global']['delete']['capability']) || user_can($dataTable->actions['global']['delete']['capability'])))
                    <a href="{{ $dataTable->actions['global']['delete']['route'] }}" class="btn btn-danger btn-delete" data-toggle="tooltip" title="Delete Selected Row(s)"><i class="fa fa-trash"></i></a>
                @endif

                {{-- reset table --}}
                <a href="javascript:;" class="btn btn-default btn-reset" data-toggle="tooltip" title="Reset Table"><i class="fa fa-power-off"></i></a>

                {{-- show/hide columns --}}
                <div class="btn-group" data-toggle="tooltip" title="Show/Hide Columns">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                        <i class="fa fa-table"></i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @foreach ($dataTable->columns as $column)
                            <li>
                                <a href="javascript:;">
                                    <input type="checkbox" name="columns[]" value="{{ $column['name'] }}" {{ !Input::has('columns') || in_array($column['name'], Input::get('columns')) ? 'checked' : '' }}>
                                    {{ $column['label'] }}
                                </a>
                            </li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a class="refresh-table" href="javascript:;"><i class="fa fa-refresh"></i> Update Table</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped border-btm1 data-table">
            <thead>
            <tr class="filters">
                <th style="width: 30px;"></th>
                @foreach ($dataTable->columns as $column)
                    @if (!Input::has('columns') || in_array($column['name'], Input::get('columns')))
                        <th>
                            @include('components.datatable.filters.' . $column['type'], $column)
                        </th>
                    @endif
                @endforeach
                <th style="width: 80px;">
                    <button class="btn btn-default btn-sm btn-block" type="submit"><i class="fa fa-search"></i></button>
                </th>
            </tr>
            <tr>
                <th><input type="checkbox" class="space0 select-toggle" {{ empty($dataTable->actions['global']['delete']) || (!empty($dataTable->actions['global']['delete']['capability']) && !user_can($dataTable->actions['global']['delete']['capability'])) ? 'disabled' : '' }}></th>
                @foreach ($dataTable->columns as $column)
                    @if (!Input::has('columns') || in_array($column['name'], Input::get('columns')))
                        <th class="{{ Input::get('sort') == $column['name'] ? 'sort-highlight' : '' }}">
                            @if (isset($column['sortable']) && !$column['sortable'])
                                {{ $column['label'] }}
                            @else
                                <a class="sortable  {{ Input::get('sort') == $column['name'] ? Input::get('order') : '' }}" data-value="{{ $column['name'] }}" href="javascript:;">
                                    <i class="fa fa-sort {{ Input::get('sort') == $column['name'] ? (Input::get('order') == 'asc' ? 'fa-sort-asc' : 'fa-sort-desc') : 'fa-sort' }}"></i> {{ $column['label'] }}
                                </a>
                            @endif
                        </th>
                    @endif
                @endforeach
                <th>Action(s)</th>
            </tr>
            </thead>
            <tbody>
            @if ($dataTable->data->isEmpty())
                <tr>
                    <td colspan="{{ (count($dataTable->columns) + 2) }}" class="text-muted">No result found.</td>
                </tr>
            @endif
            @foreach ($dataTable->data as $row)
                <tr>
                    <td><input type="checkbox" class="select-row" data-record-id="{{ $row->id }}" {{ empty($dataTable->actions['global']['delete']) || (!empty($dataTable->actions['global']['delete']['capability']) && !user_can($dataTable->actions['global']['delete']['capability'])) || (isset($row->deleted_at) && !is_null($row->deleted_at)) ? 'disabled' : '' }}></td>
                    @foreach ($dataTable->columns as $column)
                        @if (!Input::has('columns') || in_array($column['name'], Input::get('columns')))
                            <td class="{{ Input::get('sort') == $column['name'] ? 'sort-highlight' : '' }}">
                                @if (isset($column['link']))
                                    {{ $row->present()->{camel_case(str_replace('.', '_', $column['link']))} }}
                                @else
                                    {{ $row->present()->{camel_case(str_replace('.', '_', $column['name']))} }}
                                @endif
                            </td>
                        @endif
                    @endforeach
                    <td>
                        @if (!empty($dataTable->actions['record']))
                            @foreach ($dataTable->actions['record'] as $action)
                                {{ $row->present()->{camel_case(str_replace('.', '_', $action)) . 'Action'} }}
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-top1 pdng10">
        <div class="row">
            <div class="col-sm-6 space-btm15-sm text-center-sm space-top10 space-btm10 space-top0-sm">
                Showing {{ $dataTable->data->isEmpty() ? '0' : ($dataTable->data->getPerPage() * ($dataTable->data->getCurrentPage() - 1) + 1) }}
                to {{ $dataTable->data->getCurrentPage() == $dataTable->data->getLastPage() ? $dataTable->data->getTotal() : $dataTable->data->getPerPage() * $dataTable->data->getCurrentPage() }}
                of {{ $dataTable->data->getTotal() }} entries
            </div>
            <div class="col-sm-6 text-center-sm text-right">{{ $dataTable->data->links() }}</div>
        </div>
    </div>

</form>