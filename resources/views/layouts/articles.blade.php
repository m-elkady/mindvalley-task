<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

    <title>Blog</title>

</head>
<body>

<!-- header -->
<header class="w-full px-6 bg-white">
    <div class="container mx-auto max-w-xl md:flex justify-between items-center">
        <a href="#" class="block py-6 w-full text-center md:text-left md:w-auto text-grey-dark no-underline flex justify-center items-center">
            <img src="{{asset('admin/img/logo.png')}}" />
        </a>
        <div class="w-full md:w-auto text-center md:text-right">
            <!-- Login / Regsiter -->
        </div>
    </div>
</header>
<!-- /header -->

<!-- nav -->
<nav class="w-full bg-white md:pt-0 px-6 relative z-20 border-t border-b border-grey-light">
    <div class="container mx-auto max-w-xl md:flex justify-between items-center text-sm md:text-md md:justify-start">
        <div class="w-full md:w-1/2 text-center md:text-left py-4 flex flex-wrap justify-center items-stretch md:justify-start md:items-start">
            <a href="{{url('/')}}" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-grey-darker no-underline">Home</a>

        </div>
        <div class="w-full md:w-1/2 text-center md:text-right">
            <!-- extra links -->
        </div>
    </div>
</nav>
<!-- /nav -->

<!-- blog -->
<div class="w-full bg-white">

    <!-- title -->
    <div class="text-center px-6 py-12 mb-6 bg-grey-lightest border-b">
        <h1 class=" text-xl md:text-4xl pb-4">Blog</h1>
        <p class="leading-loose text-grey-dark">
            Catch up on the latest news and updates.
        </p>
    </div>
    <!-- /title -->

    <div class="container max-w-xl mx-auto md:flex items-start py-8 px-6">


        <!-- articles -->
        @yield('content')
        <!--/ articles -->

        <!-- sidebar -->
        <div class="w-full md:w-64">

            <aside class="rounded shadow overflow-hidden mb-6">
                <h3 class="text-sm bg-grey-lighter text-grey-darker py-3 px-4 border-b">Latest Posts</h3>

                <div class="p-4">
                    <ul class="list-reset leading-normal">
                        @foreach($recentPosts as $article)
                            <li><a href="{{url('post/'.$article->id)}}" class="text-grey-darkest text-sm">{{$article->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>

        </div>
        <!-- /sidebar -->

    </div>

</div>
<!-- /blog -->


</body>
