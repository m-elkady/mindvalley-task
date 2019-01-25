@extends('layouts.articles')
@section('content')
    <div class="w-full md:pr-12 mb-12">

        <article class="mb-12">
            <h2 class="mb-4">
                <a href="#" class="text-black text-xl md:text-2xl no-underline hover:underline">
                    {{$post->title}}
                </a>
            </h2>
            <div class="mb-4 text-sm text-grey-darker">
                on {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$post->created_at)->format('jS F Y')}}
            </div>

            <p class="text-grey-darker leading-normal">
                @foreach($post->article_images as $image)
                    <img src="{{asset($image->image)}}">
                @endforeach

                {!! $post->content !!}
            </p>

        </article>
    </div>
@endsection