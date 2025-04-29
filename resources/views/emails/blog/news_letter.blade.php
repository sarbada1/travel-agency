@extends('frontend.layouts.master')
@section('content')

    Lists of latest posts published since 7 days

    <ul>
        @foreach ($posts as $post)
            <li><a href="{{route('blog',$blog->slug)}}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
    <p>Click on the links to read the full posts.</p>

    Thanks,<br>
    {{ config('app.name') }}

@endsection
