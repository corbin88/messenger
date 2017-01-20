@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   @foreach ($users as $user)
                        <p><a href="{{url('conversations/'. $user->id ) }}">{{ $user->name }}</a></p>
                        <button type="submit" class="btn btn-primary">
                            <a href="{{ url('conversations/'. $user->id ) }}">Message</a>
                        </button>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
