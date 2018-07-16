@extends('layouts.app')


@section('content')
<?php
use App\User;
$user = User::find($annonce->id_author);
?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Annonce</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h3><strong>{{ $annonce->title}}</strong></h3>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h5>{{ $annonce->desc}}</h5>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            Prix:
                {{ $annonce->price}} €
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $annonce->updated_at->diffForHumans()}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Créé par :</strong>
                <a href="/user/{{$user->id }}">{{ $user->name}}</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <?php $arrayPhoto = explode('#', $annonce->photo);?>
        @foreach($arrayPhoto as $photoExp)
        @if($photoExp != "")
        <img src='{{$photoExp}}' height='200px' width='200px' />
        @endif
        @endforeach
            </div>
        </div>
    </div>
@endsection