@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Utilisateur</h2>
            </div>
            <img src="//www.gravatar.com/avatar/{{ md5($user->email) }} ?s=64">
            <!-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Retour</a>
            </div> -->
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                {{ $user->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email}}
            </div>
        </div>
    </div>
@endsection