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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('conversations/'. $user->id ) }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Message
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
