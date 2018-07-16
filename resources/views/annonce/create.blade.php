@extends('layouts.app')
@section('content')
@include('annonce.search')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter une annonce</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('annonceIndex') }}"> Retour</a>
            </div>
        </div>
    </div>


    @if (count($errors) < 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu un soucis avec votre annonce ..<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'annonces.store','method'=>'POST', 'files' => 'true')) !!}
         @include('annonce.form')
    {!! Form::close() !!}


@endsection