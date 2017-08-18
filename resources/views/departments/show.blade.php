@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 m-t">
                <section class="content-header">
                    <div class="row">
                        <h4>{{ @Lang::get('departments.show_department') }}</h4>
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
                <div class="col-sm-12">
                    <dl class="dl-horizontal">
                        <dt>{{ Lang::get('departments.department_name') }}</dt>
                        <dd>{{ $department->department_name }}</dd>

                        <dt>{{ Lang::get('departments.description') }}</dt>
                        <dd>{{ $department->description }}</dd>
                    </dl>

                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('departments', 'edit', 0))
                                {!! Html::linkRoute('departments.edit', Lang::get('departments.edit'), [$department->department_id], ['class'=>'btn btn-primary btn-block m-r']) !!}
                            @endif
                        </div>
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('departments', 'delete', 0))
                                {!! Form::open(['route' => ['departments.destroy', $department->department_id], "method" => 'DELETE']) !!}
                                {{ Form::submit(Lang::get('departments.delete'), ['class' => 'btn btn-danger btn-block']) }}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection