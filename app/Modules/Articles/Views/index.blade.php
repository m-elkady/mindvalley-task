@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> {{ __('Articles') }} </h3>
                </div>
                <div class="panel-body">
                    {{Form::Open(['route'=>'admin.articles.doOperation', 'method'=>'post'])}}

                        <!--Table Wrapper Start-->
                        <div class="table-responsive ls-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkall"/></th>
                                    <th scope="col">
                                        <a href="{{sorting_url('title')}}">{{__('Title')}}</a>
                                    </th>

                                    <th scope="col"><a href="{{sorting_url('created_at')}}">{{__('Created at')}}</a>
                                    </th>
                                    <th scope="col"><a href="{{sorting_url('updated_at')}}">{{__('Updated at')}}</a>
                                    </th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $article)
                                    <tr>
                                        <td><input type="checkbox" name="chk[]" value="{{ $article->id  }}"/></td>
                                        <td> {{$article->title}} </td>
                                        <td>{{$article->created_at}}</td>
                                        <td>{{$article->updated_at}}</td>

                                        <td class="actions">
                                            <a href="{{url('/admin/articles/edit', $article->id)}}" class="btn btn-primary">
                                                <i class="fa fa-pencil"></i> {{ __('Edit') }}
                                            </a>

                                            <a href="{{route('admin.articles.delete', $article->id)}}" class="btn btn-danger"
                                               onclick="javascript:if(!confirm('Are you sure want to delete?')) return false;">
                                                <i class="fa fa-trash-o"></i> {{ __('Delete') }}
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" id="acts" name="operation">
                                        <option value="">{{__("Choose Operation")}}</option>
                                        <option value="delete">{{__("Delete")}}</option>
                                    </select>
                                </div>
                                <div class="col-md-9 text-right">

                                    {{$data->links('elements.pagination')}}

                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection