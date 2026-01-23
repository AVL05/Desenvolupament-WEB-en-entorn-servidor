@extends('layouts.master')

@section('content')

<div class="row">
    @foreach( $books as $book )
    <div class="col-xs-6 col-sm-4 col-md-3 text-center mb-4">
        <a href="{{ url('/catalog/show/' . $book->id ) }}">
            <img src="{{$book->cover}}" style="height:200px" class="img-fluid rounded border shadow-sm">
            <h5 class="mt-2 text-dark">{{$book->title}}</h5>
        </a>
    </div>
    @endforeach
</div>

@endsection
