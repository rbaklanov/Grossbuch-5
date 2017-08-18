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
                        <h4>{{ @Lang::get('routines.edit_routine') }}</h4>
                    </div>
                    <div class="row">
                        <ol class="breadcrumb" style="background-color: #ecf0f5;">
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                            <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('routines.settings') }}</li>
                            <li class="active"><a href="/routines"><i class="fa fa-tasks" aria-hidden="true">&nbsp;</i>{{ @Lang::get('routines.all_routines') }}</a></li>
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
                {!! Form::model($routine, ['route' => ['routines.update', $routine->routine_id], 'class'=>'form-horizontal', 'method' => 'PUT', 'id' => 'update_routine_form']) !!}
                {!! Form::hidden('routine_id', $routine->routine_id) !!}
                <div class="col-sm-12">
                    <div class="form-group">
                        @if (Session::has('error'))
                            <div class="alert alert-error" role="alert" style="display: block;">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group @if ($errors->has('routine_name')) has-error @endif">
                        {{ Form::label('routine_name', Lang::get('routines.routine_name'), ['class' => 'col-sm-4 control-label text-right']) }}
                        <div class="col-sm-8">
                            {{ Form::text('routine_name', old('routine_name'), ['class' => 'form-control', 'placeholder' => Lang::get('routines.name_example')]) }}
                            @if ($errors->has('routine_name')) <p class="help-block">{{ $errors->first('routine_name') }}</p> @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                        {{ Form::label('description', Lang::get('common.description'), ['class' => 'col-sm-4 control-label text-right']) }}
                        <div class="col-sm-8">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => Lang::get('routines.brief')]) }}
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="col-sm-6">
                                {!! Html::linkRoute('routines.show', Lang::get('routines.cancel'), [$routine->routine_id], ['class'=>'btn btn-primary btn-block m-r']) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::submit(Lang::get('routines.update'), ['class' => 'form-control btn btn-success btn-block']) !!}
                            </div>
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