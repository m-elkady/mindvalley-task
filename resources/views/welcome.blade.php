@extends('layouts.articles')
@section('content')
    <div class="w-full md:pr-12 mb-12">
        @foreach($data as $article)
            <article class="mb-12">
                <h2 class="mb-4">
                    <a href="{{url('post/'.$article->id)}}" class="text-black text-xl md:text-2xl no-underline hover:underline">
                        {{$article->title}}
                    </a>
                </h2>

                <div class="mb-4 text-sm text-grey-darker">
                    on {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$article->created_at)->format('jS F Y')}}
                </div>

                <p class="text-grey-darker leading-normal">
                    {!! \Illuminate\Support\Str::limit($article->content,200) !!}
                </p>

            </article>
        @endforeach

        {{$data->links('elements.front-pagination')}}
    </div>
@endsection