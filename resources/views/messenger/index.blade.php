@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            <a class="btn btn-primary" href="/messages/create"> Créer un message</a>
            </div>
        </div>
    </div>
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
    {!! $threads->links() !!}
@stop