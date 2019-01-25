@php
    $labelText = null;
    if(isset($attributes['label'])){
        $labelText = $attributes['label']['text'] ?? $attributes['label'];
    }
@endphp
<div class="form-group">
    {{ Form::label($name, $labelText, ['class' => 'control-label']) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if(!$errors->isEmpty() && $errors->first($name))
        <div class="error-message"> {{ $errors->first($name) }}</div>
    @endif
</div>