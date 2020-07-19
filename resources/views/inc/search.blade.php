{!! Form::open(['action' => 'SearchesController@store', 'method' => 'POST']) !!}

    <div class="form-group">
        {{Form::label('inputSearchLabel', 'Word Search', ['class' => 'sr-only', 'for' => 'inputSearch'])}}
        {{Form::text('word', $word, ['class' => 'form-control', 'placeholder' => 'Search...', 'id' => 'inputSearch', 'required' => 'true', 'autofocus' => 'true'])}}
    </div>
    {{Form::submit('Search!', ['class' => 'btn btn-lg btn-primary btn-block'])}}

{!! Form::close() !!}