@foreach( $items as $key => $item )
    @php
        $id = isset($item['id']) ? $item['id'] : camel_case($key);
        $url = $item['url'] ?? "#";
        $class = !empty($item['subs'])? 'folder' : 'file';
    @endphp
    <li id="{{$id}}">
        <a href="{{url($url)}}" class="@if(url($url) == request()->url()) {{'active'}} @endif ">
            @if(isset($item['icon']))<i class="fa {{ $item['icon']??'' }}"></i>@endif
            <span>{{__($key)}}</span>
        </a>
        @if($class == 'folder')
            <ul> @include('elements.sideMenu', ['items'=>$item['subs']]) </ul>
        @endif

    </li>
@endforeach


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            const $id = '{{isset($menuId) ? $menuId : camel_case(request()->segment(2))}}';
            $('#' + $id).addClass('active');

        });
    </script>
@endpush









