@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 m-t">
                <section class="content-header">
                    <div class="row">
                        <h4>{{ @Lang::get('users.show_user') }}</h4>
                    </div>
                    <div class="row">
                        <ol class="breadcrumb" style="background-color: #ecf0f5;">
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                            <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('users.settings') }}</li>
                            <li class="active"><a href="/users"><i class="fa fa-users" aria-hidden="true">&nbsp;</i>{{ @Lang::get('users.all_users') }}</a></li>
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
                <div class="col-sm-8 b-r">
                    <dl class="dl-horizontal">
                        <dt>{{ Lang::get('users.name') }}</dt>
                        <dd>{{ $user->name }}</dd>

                        <dt>{{ Lang::get('users.email') }}</dt>
                        <dd>{{ $user->email }}</dd>

                        <dt>{{ Lang::get('users.role') }}</dt>
                        <dd>{{ $user->role_id }}</dd>

                        <dt>{{ Lang::get('users.client') }}</dt>
                        <dd>{{ $user->client_id }}</dd>

                        <dt>{{ Lang::get('users.department') }}</dt>
                        <dd>{{ $department->department_name }}</dd>

                        <dt>{{ Lang::get('users.position') }}</dt>
                        <dd>{{ $user->position_id }}</dd>

                        <dt>{{ Lang::get('users.birthday') }}</dt>
                        <dd>{{ $user->birthday }}</dd>

                        <dt>{{ Lang::get('common.description') }}</dt>
                        <dd>{{ $user->description }}</dd>
                    </dl>

                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('users', 'edit', 0))
                                {!! Html::linkRoute('users.edit', Lang::get('users.edit'), [$user->id], ['class'=>'btn btn-primary btn-block m-r']) !!}
                            @endif
                        </div>
                        <div class="col-sm-6">
                            @if ($user->hasAccessTo('users', 'delete', 0))
                                {!! Form::open(['route' => ['users.destroy', $user->user_id], "method" => 'DELETE']) !!}
                                    {{ Form::submit(Lang::get('users.delete'), ['class' => 'btn btn-danger btn-block']) }}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                    <label class="ctrl-label">{{ @Lang::get('users.avatar_message') }}</label>
                    <div class="logo-block">
                        <div v-if="!image">
                            @if( $user->avatar_image_name != null)
                                <img src="/img/{{ $user->avatar_image_name }}" />
                            @else
                                <img src="/img/no-master.png" alt="">
                            @endif
                        </div>
                        <div v-else>
                            <img :src="image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection