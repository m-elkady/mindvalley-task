<ol class="breadcrumb">
    <li>
        <a href="{{route('home')}}"><i class="fa fa-home"></i></a>
    </li>

    <li>
        <a href="{{route('admin.home')}}">Admin</a>
    </li>
    @php
        $count = count(request()->segments());
    @endphp
    @for($i = 2; $i <= $count; $i++)
        @if(is_numeric(request()->segment($i)))
            @continue
        @endif
        <li>
            <a href="{{ url( implode( '/', array_slice(request()->segments(), 0 ,$i, true)))}}">
                {{ucfirst(request()->segment($i))}}
            </a>
        </li>
    @endfor
</ol>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            const lastLi = $('.breadcrumb li:last');
            lastLi.html(lastLi.find('a').text());
        });
    </script>
@endpush