<?php
$url = explode('/', $_SERVER['REQUEST_URI']);
$id = Auth::user()->id;
if($id != $url[2]){
    echo "<script>
    document.location.href='/user/".$id."/edit'
    </script>";
}
?>

@extends('layouts.app')

@section('content')
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


    {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
        @include('user.form')
    {!! Form::close() !!}


@endsection