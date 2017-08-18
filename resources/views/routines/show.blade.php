@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 m-t">
                <section class="content-header">
                    <div class="row">
                        <h4>{{ @Lang::get('routines.show_routine') }}</h4>
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
                <div class="col-sm-12">
                    <dl class="dl-horizontal">
                        <dt>{{ Lang::get('routines.routine_name') }}</dt>
                        <dd>{{ $routine->routine_name }}</dd>

                        <dt>{{ Lang::get('routines.description') }}</dt>
                        <dd>{{ $routine->description }}</dd>
                    </dl>

                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('routines', 'edit', 0))
                                {!! Html::linkRoute('routines.edit', Lang::get('routines.edit'), [$routine->routine_id], ['class'=>'btn btn-primary btn-block m-r']) !!}
                            @endif
                        </div>
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('routines', 'delete', 0))
                                {!! Form::open(['route' => ['routines.destroy', $routine->routine_id], "method" => 'DELETE']) !!}
                                {{ Form::submit(Lang::get('routines.delete'), ['class' => 'btn btn-danger btn-block']) }}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection