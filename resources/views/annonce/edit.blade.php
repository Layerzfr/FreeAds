<?php
use App\Annonce;
$url = explode('/', $_SERVER['REQUEST_URI']);
$annonce = Annonce::find($url[2]);

$id = Auth::user()->id;
if($id != $annonce->id_author){
    echo "<script>
    document.location.href='/annonces'
    </script>";
}
?>

@extends('layouts.app')
@section('content')
@include('annonce.search')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Utilisateur</h2>
            </div>
            <!-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Retour</a>
            </div> -->
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu une erreur avec vos inputs.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($annonce, ['method' => 'PATCH','route' => ['annonces.update', $annonce->id],  'files' => 'true']) !!}
        @include('annonce.formUpdate')
    {!! Form::close() !!}


@endsection