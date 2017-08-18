@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid" id="app">
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
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'class'=>'form-horizontal', 'method' => 'PUT', 'files' => 'true', 'id' => 'update_user_form']) !!}
                {!! Form::hidden('user_id', $user->id) !!}
                <div class="col-sm-8 b-r">
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {{ Form::label('name', Lang::get('users.name'), ['class' => 'col-sm-3 control-label text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => Lang::get('users.name_example')]) }}
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

                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <a href="#change-password" data-toggle="collapse" class="btn btn-link btn-xs">
                                &nbsp;&nbsp;{{ @Lang::get('users.change_password') }}&nbsp;&nbsp;
                                <i class="fa fa-caret-down"></i></a>
                        </div>
                    </div>

                    <div class="collapse" id="change-password">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="alert alert-success" id="update_password_success_alert">
                                {{--<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>--}}
                                @lang('users.success')
                            </div>
                            <div class="alert alert-error" id="update_password_error_alert">
                                {{--<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>--}}
                                <span id="update_password_error_container">@lang('users.error')</span>
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('old_password')) has-error @endif">
                            {{ Form::label('old_password', Lang::get('users.old_password'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => Lang::get('users.password_min_length')]) }}
                                @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            {{ Form::label('new_password', Lang::get('users.new_password'), ['class' => 'col-sm-3 control-label text-right']) }}
                            <div class="col-sm-9">
                                {{ Form::password('new_password', ['class' => 'form-control', 'placeholder' => Lang::get('users.password_min_length')]) }}
                                @if ($errors->has('new_password')) <p class="help-block">{{ $errors->first('new_password') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('new_password_confirmation')) has-error @endif">
                            {{ Form::label('new_password_confirmation', Lang::get('users.password_confirmation'), ['class' => 'col-sm-3 control-label text-right', 'style' => 'padding-left:0;']) }}
                            <div class="col-sm-9">
                                {{ Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => Lang::get('users.confirm_your_password')]) }}
                                @if ($errors->has('new_password_confirmation')) <p class="help-block">{{ $errors->first('new_password_confirmation') }}</p> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row" style="margin-right: 0;">
                                <div class="col-sm-12">
                                    <input type="button" value="{{ @Lang::get('users.change_password') }}" class="btn btn-primary pull-right" id="change-password-btn">
                                </div>
                            </div>
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
                            {{ Form::select('client_id', $clients , null , ['class' => 'form-control', '@change' => 'onSelectChange', 'v-model' => 'client_filtered', 'placeholder' => Lang::get('users.not_chosen')]) }}
                            @if ($errors->has('client_id')) <p class="help-block">{{ $errors->first('client_id') }}</p> @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('department_id')) has-error @endif">
                        {{ Form::label('department_id', Lang::get('users.department'), ['class' => 'col-sm-3 control-label text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::select('department_id', $departments , null , ['class' => 'form-control', 'id' => 'department_id', 'placeholder' => Lang::get('users.not_chosen')]) }}
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
                            <input class="form-control" name="birthday" data-days-offset="-1" type="text" id="birthday" value= {{ $user_birthday }}>
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

                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('users.show', Lang::get('users.cancel'), [$user->id], ['class'=>'btn btn-primary btn-block m-r']) !!}
                         </div>
                        <div class="col-sm-6">
                            {!! Form::submit(Lang::get('users.update'), ['class' => 'form-control btn btn-success btn-block']) !!}
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
        const app = new Vue({
            el: '#app',
            data: function() {
                return {
                    image: '',
                    role_filtered: 0,
                    client_filtered: 0,
                    department_filtered: 0,
                    position_filtered: 0
                }
            },
            methods: {
                onFileChange(e) {
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.createImage(files[0]);
                },

                createImage(file) {
                    let image = new Image();
                    let reader = new FileReader();
                    let vm = this;

                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                removeImage(e) {
                    this.image = '';
                },

                onSelectChange(e) {
                    console.log(this.client_filtered);

                    if(0 != this.client_filtered) {
                        $('select[name="department_id"]').prop( "disabled", true );
                        $('select[name="position_id"]').prop( "disabled", true );
                    } else {
                        $('select[name="department_id"]').prop( "disabled", false );
                        $('select[name="position_id"]').prop( "disabled", false );
                    }
                }
            }
        });
        $(document).ready(function() {
            var selector = $('#birthday');

            selector.datepicker({
                autoclose: true,
                orientation: 'auto',
                format: 'dd-mm-yyyy',
                weekStart: 1,
                language: 'ru'
            });

            $('#change-password').on('shown.bs.collapse', function(){
                $('a[href="#change-password"] .fa.fa-caret-down').toggleClass('fa-caret-down fa-caret-up');
            });

            $('#change-password').on('hidden.bs.collapse', function(){
                $('a[href="#change-password"] .fa.fa-caret-up').toggleClass('fa-caret-up fa-caret-down');
            });

            $('#change-password-btn').on('click', function (e) {
                $.ajax({
                    url: '/user/updatePassword',
                    type: 'put',
                    dataType: 'json',
                    data: $('form#update_user_form').serialize(),
                    success: function (data) {
                        console.log(data);

                        if (data.success) {
                            $("#update_password_success_alert").alert();
                            $("#update_password_success_alert").fadeTo(2000, 500).slideUp(500, function () {
                                $("#update_password_success_alert").slideUp(500);
                            });
                        } else {
                            $('#update_password_error_container').html(data.error);
                            $("#update_password_error_alert").alert();
                            $("#update_password_error_alert").fadeTo(3000, 500).slideUp(500, function () {
                                $("#update_password_error_alert").slideUp(500);
                            });
                        }
                    },
                    error: function (jqXHR, errStr) {
                        console.log(errStr);
                    }
                });
            });
        });
    </script>
@endsection