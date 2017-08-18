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
                    <li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('positions.settings') }}</li>
                    <li class="active"><a href="/positions"><i class="fa fa-vcard" aria-hidden="true">&nbsp;</i>{{ @Lang::get('positions.all_positions') }}</a></li>
                </ol>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('positions.create') }}" class="btn btn-primary m-r pull-right">{{ Lang::get('positions.create_new') }}</a>
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
                    <th>{{ Lang::get('positions.position_name') }}</th>
                    <th>{{ Lang::get('positions.department_name') }}</th>
                    <th>{{ Lang::get('positions.description') }}</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($positions as $position)
                        <tr>
                            <th class="text-center">{{ $position->position_id }} </th>
                            <td> {{ $position->position_name }} </td>
                            <td> {{ $position->department->department_name}} </td>
                            <td> {{ $position->description }} </td>
                            <td class="text-center" style="">
                                @if ($user->hasAccessTo('user', 'edit', 0))
                                    <a href="{{ route('positions.edit', $position->position_id) }}" id="user_edit" class="table-action-link m-r"><i class='fa fa-pencil'></i></a>
                                @endif
                                @if ($user->hasAccessTo('position', 'delete', 0))
                                    {!! Form::open(
                                        [
                                            'route' => ['positions.destroy', $position->position_id],
                                            'id' => 'form'.$position->position_id,
                                            'style' => 'max-width: 32px; margin:0; display: inline; float: none;',
                                            'method' => 'DELETE'
                                        ])
                                    !!}
                                    <a href="javascript: submitform('#form{{$position->position_id}}')" class="table-action-link"><i class='fa fa-trash-o'></i></a>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $positions->render() !!}
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