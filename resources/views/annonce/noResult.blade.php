@extends('layouts.app')
@section('content')
@include('annonce.search')
<?php use App\Annonce;?>
<div class="container">
    @if(isset($message))
    <p>{{$message}}</p>
    @endif
</div>
@endsection