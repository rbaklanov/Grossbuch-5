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
                        <h4>{{ @Lang::get('users.edit_user') }}</h4>
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
            <div class="col-sm-8 col-sm-offset-2 well">
                {!! Form::open(['route' => 'users.store', 'class'=>'form-horizontal', 'files' => 'true', 'id' => 'create_user_form']) !!}
                    <div class="col-sm-8 b-r">
                        <div class="col-sm-12">
                            <div class="form-group">
                                @if (Session::has('error'))
                                    <div class="alert alert-error" role="alert" style="display: block;">
                                        <p>{{ Session::get('error') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            {{ Form::label('name', Lang::get('users.name'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => Lang::get('users.name_example')]) }}
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            {{ Form::label('email', Lang::get('users.email'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => Lang::get('users.email_example')]) }}
                                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            {{ Form::label('password', Lang::get('users.password'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('users.password_min_length')]) }}
                                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                            {{ Form::label('password_confirmation', Lang::get('users.password_confirmation'), ['class' => 'col-sm-3 control-label text-right', 'style' => 'padding-left:0']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => Lang::get('users.confirm_your_password')]) }}
                                @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('role_id')) has-error @endif">
                            {{ Form::label('role_id', Lang::get('users.role'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::select('role_id', $roles , null , ['class' => 'form-control', 'placeholder' => Lang::get('users.not_chosen')]) }}
                                @if ($errors->has('role_id')) <p class="help-block">{{ $errors->first('role_id') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('client_id')) has-error @endif">
                            {{ Form::label('client_id', Lang::get('users.client'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::select('client_id', $clients , null , ['class' => 'form-control', 'placeholder' => Lang::get('users.not_chosen')]) }}
                                @if ($errors->has('client_id')) <p class="help-block">{{ $errors->first('client_id') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('department_id')) has-error @endif">
                            {{ Form::label('department_id', Lang::get('users.department'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::select('department_id', $departments , null , ['class' => 'form-control', 'placeholder' => Lang::get('users.not_chosen')]) }}
                                @if ($errors->has('department_id')) <p class="help-block">{{ $errors->first('department_id') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('position_id')) has-error @endif">
                            {{ Form::label('position_id', Lang::get('users.position'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::select('position_id', $positions , null , ['class' => 'form-control', 'placeholder' => Lang::get('users.not_chosen')]) }}
                                @if ($errors->has('position_id')) <p class="help-block">{{ $errors->first('position_id') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('birthday')) has-error @endif">
                            {{ Form::label('birthday', Lang::get('users.birthday'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                <input class="form-control" name="birthday" data-days-offset="-1" type="text" id="birthday">
                                @if ($errors->has('birthday')) <p class="help-block">{{ $errors->first('birthday') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            {{ Form::label('description', Lang::get('common.description'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => Lang::get('users.brief')]) }}
                                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 m-t">
                                {!! Form::submit(Lang::get('users.create_new'), ['class' => 'form-control btn btn-primary center-block']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 text-center">
                        <label class="ctrl-label">{{ @Lang::get('users.avatar_message') }}</label>
                        <div class="logo-block">
                            <div v-if="!image">
                                <img src="/img/no-master.png" alt="">
                            </div>
                            <div v-else>
                                <img :src="image" />
                            </div>
                        </div>
                        <span class="btn btn-info btn-file">
                            {{  @Lang::get('users.load_avatar') }}<input type="file" name="avatar" @change="onFileChange">
                        </span>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('page-specific-scripts')
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.ru.js"></script>
    <input class="datepicker"/>
    <script>
        $(document).ready(function() {
            let selector = $('#birthday'), today = new Date();

            selector.datepicker({
                autoclose: true,
                orientation: 'auto',
                format: 'dd-mm-yyyy',
                weekStart: 1,
                language: 'ru'
            });

            selector.datepicker('update', today);
        });
    </script>
@endsection

{{--<script>--}}
    {{--function submitform(form_id){--}}
        {{--$('#create_user_form_submit').addClass('disabled');--}}
        {{--$('#create_user_form_error_container').html('');--}}
        {{--$.ajax({--}}
            {{--url: '/user/validateUserForm',--}}
            {{--type: 'post',--}}
            {{--dataType: 'json',--}}
            {{--data: $('form#create_user_form').serialize(),--}}
            {{--success: function(data) {--}}
                {{--$('#create_user_form_submit').removeClass('disabled');--}}
                {{--console.log(data);--}}

                {{--if (data.success) {--}}
                    {{--$("#create_user_form_success_alert").alert();--}}
                    {{--$("#create_user_form_success_alert").fadeTo(2000, 500).slideUp(500, function() {--}}
                        {{--$("#create_user_form_success_alert").slideUp(500);--}}
                    {{--});--}}
                    {{--$(form_id).submit();--}}
                {{--} else {--}}
                    {{--$('#create_user_form_error_container').html(data.error);--}}
                    {{--$("#create_user_form_error_alert").alert();--}}
                    {{--$("#create_user_form_error_alert").fadeTo(3000, 500).slideUp(500, function() {--}}
                        {{--$("#create_user_form_error_alert").slideUp(500);--}}
                    {{--});--}}
                {{--}--}}
            {{--},--}}
            {{--error: function(jqXHR, errStr) {--}}
                {{--$('#create_user_form_submit').removeClass('disabled');--}}
                {{--console.log(errStr);--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}