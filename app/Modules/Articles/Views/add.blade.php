@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php
                        if (!$data->id) {
                            echo __('Add Article');
                        } else {
                            echo __('Edit Article');
                        }
                        ?></h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route'=>[$route, $data->id], 'files' => true, 'id' => 'ArticleForm']) !!}
                    {!! Form::hidden('id', $data->id) !!}
                    {!! Form::bsText('title', $data->title) !!}
                    {!! Form::bsTextArea('content', $data->content, ['class'=>'summernote']) !!}
                    {!! Form::bsTextArea('tags', $data->tags, ['class'=>'tags']) !!}

                    <div id="options-div">
                        <div id="Options" class="row">
                            <?php
                            $section_count = 0;
                            if (!$data->article_images->isEmpty()) {
                                foreach ($data->article_images as $j => $option) {
                            ?>
                            <div id='row<?php echo $j ?>' class="col-md-11 url-div">
                                <div class="row">
                                    <div class="col-md-11">
                                        {!! Form::hidden('article_images[' . $j . '][id]',$option->id, ['class' => 'form-control']) !!}
                                        {!! Form::label('article_images[' . $j . '][image]','Image') !!}
                                        <a href="{{asset($option->image)}}" target="_blank"> view </a>
                                        {!! Form::file('article_images[' . $j . '][image]', ['class' => 'form-control']) !!}
                                    </div>
                                    <a href='#' class="delete-section2 btn btn-small">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $section_count++;
                            }
                         } else {
                            ?>
                            <div id="row0" class="url-div col-md-11">
                                <div class="row">
                                    <div class="col-md-11">
                                        {!! Form::label('article_images[0][image]','Image') !!}
                                        {!! Form::file('article_images[0][image]',['class' => 'form-control']) !!}
                                    </div>
                                    <a href='#' class="delete-section2 btn btn-small">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <a href="#" class="add-author btn">
                            <i class="fa fa-plus-circle"></i> {{ __('Add Image')}}
                        </a>
                    </div>

                    {!! Form::submit('Save',['class'=>'btn btn-lg btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('admin/css/plugins/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('admin/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/selectize.min.js') }}"></script>

    <script>
        $(function () {
            var selectized = $('.tags').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function (input) {
                    return {
                        value: input,
                        text: input
                    }
                },
                render: {
                    item: function (data, escape) {
                        return '<div>' + escape(data.text) + '</div>';
                    }
                },
                onDelete: function (values) {
                    return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
                },
            });
            $("#ArticleForm").validate({
                errorClass: "error-message",
                highlight: function (label) {
                    $(label).closest('.form-group').addClass('has-error');
                    if ($(label).closest('.tab-content').length) {
                        const $fieldset = $(label).closest('.tab-content');
                        if ($($fieldset).find(".tab-pane.active:has(div.has-errors)").length == 0) {
                            $($fieldset).find(".tab-pane:has(div.has-errors)").each(function (index, tab) {
                                $('a[href=#' + $(label).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                            });
                        }
                    }
                },
                'ignore': [],
                errorElement: "div",
                rules: {
                    title: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: '{{__('Required') }}',
                    },
                    category_id: {
                        required: '{{__('Required') }}',
                    },
                },
                success: function (label, element) {
                    label.parent().removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function (label, element) {
                    // position error label after generated textarea

                    if (element.is("textarea")) {
                        label.insertAfter(element.next());
                    } else {
                        label.insertAfter(element);
                    }
                }
            });

            $('.add-author').on('click', function () {
                if ($('#Options').is(':visible')) {
                    $('#Options').append('<div class="url-div col-md-11">' + $('.url-div:first').html().replace(/\[0\]/g, '[' + $('.url-div').length + ']').replace(/-0-/g, '-' + $('.url-div').length + '-') + '</div>');
                    $('#Options .url-div:last input').val('');
                    $("#Options .url-div:last .badge").remove();
                    $('#Options .url-div:last textarea').val('');
                    $('#Options .url-div:last .asset-type').trigger('change');
                    $('#Options .url-div:last').find('.image_between').remove();
                } else {
                    $('#Options').show();
                }
                return false;
            });
        });

        $(document).on('click', '.delete-section2', function () {
            if (confirm('<?php echo __('Are you sure you want to delete this item?') ?>')) {
                if ($('#Options').find('.url-div').length <= 1) {
                    $(this).closest('.url-div').find('input').val('');

                } else {
                    $(this).closest('.url-div').remove();
                }
            }
            return false;
        });

    </script>
@endpush



