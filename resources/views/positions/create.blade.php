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
                        <h4>{{ @Lang::get('positions.edit_position') }}</h4>
                    </div>
                    <div class="row">
                        <ol class="breadcrumb" style="background-color: #ecf0f5;">
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                            <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('positions.settings') }}</li>
                            <li class="active"><a href="/positions"><i class="fa fa-vcard" aria-hidden="true">&nbsp;</i>{{ @Lang::get('positions.all_positions') }}</a></li>
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
                {!! Form::open(['route' => 'positions.store', 'class'=>'form-horizontal', 'files' => 'true', 'id' => 'create_position_form']) !!}
                <div class="col-sm-12">
                    <div class="form-group">
                        @if (Session::has('error'))
                            <div class="alert alert-error" role="alert" style="display: block;">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group @if ($errors->has('department_id')) has-error @endif">
                        {{ Form::label('department_id', Lang::get('positions.department'), ['class' => 'col-sm-4 control-label text-right']) }}
                        <div class="col-sm-8">
                            {{ Form::select('department_id', $departments , null , ['class' => 'form-control', 'placeholder' => Lang::get('positions.department_not_chosen')]) }}
                            @if ($errors->has('department_id')) <p class="help-block">{{ $errors->first('department_id') }}</p> @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('position_name')) has-error @endif">
                        {{ Form::label('position_name', Lang::get('positions.position_name'), ['class' => 'col-sm-4 control-label text-right']) }}
                        <div class="col-sm-8">
                            {{ Form::text('position_name', old('position_name'), ['class' => 'form-control', 'placeholder' => Lang::get('positions.name_example')]) }}
                            @if ($errors->has('position_name')) <p class="help-block">{{ $errors->first('position_name') }}</p> @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                        {{ Form::label('description', Lang::get('positions.description'), ['class' => 'col-sm-4 control-label text-right']) }}
                        <div class="col-sm-8">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => Lang::get('positions.brief')]) }}
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 m-t">
                            {!! Form::submit(Lang::get('positions.create_new'), ['class' => 'form-control btn btn-primary center-block']) !!}
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