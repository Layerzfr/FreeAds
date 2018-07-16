<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Titre:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Titre','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {!! Form::textarea('desc', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Prix:</strong>
            {!! Form::number('price', null, array('placeholder' => '€','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Photo:</strong>
            {{ Form::file('photo[]', array('multiple'=>true)) }}
        </div>
    </div>
    {{ Form::hidden('id_author', Auth::user()->id) }}
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</div>