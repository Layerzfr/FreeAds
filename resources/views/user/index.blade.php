@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Modification Users</h2>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name}}</td>
        <td>{{ $user->email}}</td>
        <td>{{ $user->password}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
            
            @if($user->name !=  Auth::user()->name )
            {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endif
            
        </td>
    </tr>
    @endforeach
    </table>


    {!! $users->links() !!}
@endsection