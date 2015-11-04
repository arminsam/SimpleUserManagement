<select type="text" class="form-control input-sm" name="search[{{ $column['name'] }}]" {{ isset($column['filterable']) && !$column['filterable'] ? 'disabled' : '' }}>
    <option value="">--Select--</option>
    @foreach($column['options'] as $value => $option)
        <option value="{{ $value }}" {{ Input::has('search') && isset(Input::get('search')[$column['name']]) && Input::get('search')[$column['name']] == $value ? 'selected' : '' }}>
            {{$option}}
        </option>
    @endforeach
</select>