@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid">
        {{--<div class="row">--}}
        {{--@include('partials.alerts');--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-sm-6 m-t">
                <section class="content-header">
                    <div class="row">
                        <h4>{{ @Lang::get('departments.edit_department') }}</h4>
                    </div>
                    <div class="row">
                        <ol class="breadcrumb" style="background-color: #ecf0f5;">
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                            <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('departments.settings') }}</li>
                            <li class="active"><a href="/departments"><i class="fa fa-address-book" aria-hidden="true">&nbsp;</i>{{ @Lang::get('departments.all_departments') }}</a></li>
                        </ol>
                    </div>
                </section>
            </div>
        </div>
        <div class="col-sm-12">
            <hr>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 well">
                {!! Form::open(['route' => 'departments.store', 'class'=>'form-horizontal', 'files' => 'true', 'id' => 'create_department_form']) !!}
                <div class="col-sm-12">
                    <div class="form-group">
                        @if (Session::has('error'))
                            <div class="alert alert-error" role="alert" style="display: block;">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group @if ($errors->has('department_name')) has-error @endif">
                        {{ Form::label('department_name', Lang::get('departments.department_name'), ['class' => 'col-sm-3 control-label text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::text('department_name', old('department_name'), ['class' => 'form-control', 'placeholder' => Lang::get('departments.name_example')]) }}
                            @if ($errors->has('department_name')) <p class="help-block">{{ $errors->first('department_name') }}</p> @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                        {{ Form::label('description', Lang::get('common.description'), ['class' => 'col-sm-3 control-label text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => Lang::get('departments.brief')]) }}
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 m-t">
                            {!! Form::submit(Lang::get('departments.create_new'), ['class' => 'form-control btn btn-primary center-block']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('page-specific-scripts')
@endsection