@extends('layouts.app')

@section('content')
<?php
use App\Annonce;
$annonces = Annonce::latest()->paginate(5);
?>
@include('annonce.search')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Annonces</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('annonceCreate') }}"> Créer une annonce</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

     @foreach ($annonces as $annonce)
    
     <div class="row">
        <div class="col-lg-12 text-center">
            <h2><a href="/annonces/{{$annonce->id}}"> {{ $annonce->title }}</a>
            </h2>
        </div>
        <div class="col-lg-12 text-center">
            <p>{!! $annonce->desc !!}</p>
        </div>
        <div class="col-lg-12 text-center">
            <p>Prix: <strong>{!! $annonce->price !!} €</strong> </p>
        </div>
        <div class="col-lg-12 text-center">

        <?php $arrayPhoto = explode('#', $annonce->photo); $count = count($arrayPhoto)-1; $i =1;?>
        @foreach($arrayPhoto as $photoExp)
        @if($photoExp != "" && $i<5 )
        <img src='{{$photoExp}}' height='200px' width='200px' />
        @endif
        <?php $i++;?>
        @endforeach
        <?php if($i>4){ echo "<p><strong>+".($i - 6) . "autres photos</strong></p>";} ?>
        </div>
        @if ($annonce->id_author === Auth::user()->id)
        <div class="col-lg-12 text-center">
        <a class="btn btn-primary" href="{{ route('annonces.edit',$annonce->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['annonces.destroy', $annonce->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
        
    @endif
    </div>
            
        
    @endforeach
    {!! $annonces->links() !!}

@endsection