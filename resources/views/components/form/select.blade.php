@php
    $labelText = null;
    if(isset($attributes['label'])){
        $labelText = $attributes['label']['text'] ?? $attributes['label'];
    }

    $enableFirst = $attributes['enableFirst'] ?? null;

    $empty = $attributes['empty'] ?? null;

    if($empty){
        $options = array_merge([$empty], $options);
    }
@endphp

<div class="form-group">
    {{ Form::label($name, $labelText, ['class' => 'control-label']) }}
    {{ Form::select($name, $options, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if(!$errors->isEmpty() && $errors->first($name))
        <div class="error-message"> {{ $errors->first($name) }}</div>
    @endif
</div>

@push('scripts')
    @if($empty && !$enableFirst)
        <script>
            $(function () {
                $('#{{$name}} > option[value="0"]').attr('disabled', true);
            });
        </script>
    @endif
@endpush