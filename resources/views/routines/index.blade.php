@extends('adminlte::layouts.app')
@section('htmlheader_title')
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.alerts');
        </div>
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb" style="background-color: #ecf0f5;">
                    <li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                    <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('routines.settings') }}</li>
                    <li class="active"><a href="/routines"><i class="fa fa-tasks" aria-hidden="true">&nbsp;</i>{{ @Lang::get('routines.all_routines') }}</a></li>
                </ol>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('routines.create') }}" class="btn btn-primary m-r pull-right">{{ Lang::get('routines.create_new') }}</a>
            </div>
        </div>
        <div class="col-sm-12">
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover table-condensed">
                    <thead>
                    <th class="text-center">#</th>
                    <th>{{ Lang::get('routines.routine_name') }}</th>
                    <th>{{ Lang::get('routines.description') }}</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($routines as $routine)
                        <tr>
                            <th class="text-center">{{ $routine->routine_id }} </th>
                            <td> {{ $routine->routine_name }} </td>
                            <td> {{ $routine->description }} </td>
                            <td class="text-center" style="">
                                @if ($user->hasAccessTo('user', 'edit', 0))
                                    <a href="{{ route('routines.edit', $routine->routine_id) }}" id="user_edit" class="table-action-link m-r"><i class='fa fa-pencil'></i></a>
                                @endif
                                @if ($user->hasAccessTo('routine', 'delete', 0))
                                    {!! Form::open(
                                        [
                                            'route' => ['routines.destroy', $routine->routine_id],
                                            'id' => 'form'.$routine->routine_id,
                                            'style' => 'max-width: 32px; margin:0; display: inline; float: none;',
                                            'method' => 'DELETE'
                                        ])
                                    !!}
                                    <a href="javascript: submitform('#form{{$routine->routine_id}}')" class="table-action-link"><i class='fa fa-trash-o'></i></a>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $routines->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function submitform(form_id){
        $(form_id).submit();
    }
</script>