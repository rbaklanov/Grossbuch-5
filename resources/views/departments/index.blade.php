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
                {{--<ol class="breadcrumb" style="background-color: #ecf0f5;">--}}
                    {{--<li><a href="/home"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>--}}
                    {{--<li><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('departments.settings') }}</li>--}}
                    {{--<li class="active"><a href="/departments"><i class="fa fa-address-book" aria-hidden="true">&nbsp;</i>{{ @Lang::get('departments.all_departments') }}</a></li>--}}
                {{--</ol>--}}
                <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="/home"><span class="icon is-small"><i class="fa fa-home"></i></span><span>{{ @Lang::get('common.home') }}</span></a></li>
                        <li><span class="icon is-small"><i class="fa fa-gears"></i></span><span>{{ @Lang::get('departments.settings') }}</span></li>
                        <li class="is-active"><a href="/departments"><span class="icon is-small"><i class="fa fa-address-book"></i></span><span>{{ @Lang::get('departments.all_departments') }}</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('departments.create') }}" class="btn btn-primary m-r pull-right">{{ Lang::get('departments.create_new') }}</a>
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
                        <th>{{ Lang::get('departments.department_name') }}</th>
                        <th>{{ Lang::get('departments.description') }}</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <th class="text-center">{{ $department->department_id }} </th>
                                <td> {{ $department->department_name }} </td>
                                <td> {{ $department->description }} </td>
                                <td class="text-center">
                                    @if ($user->hasAccessTo('user', 'edit', 0))
                                        <a href="{{ route('departments.edit', $department->department_id) }}" id="user_edit" class="table-action-link m-r"><i class='fa fa-pencil'></i></a>
                                    @endif
                                    @if ($user->hasAccessTo('partner', 'delete', 0))
                                        {!! Form::open(
                                            [
                                                'route' => ['departments.destroy', $department->department_id],
                                                'id' => 'form'.$department->department_id,
                                                'style' => 'max-width: 32px; margin:0; display: inline; float: none;',
                                                'method' => 'DELETE'
                                            ])
                                        !!}
                                        <a href="javascript: submitform('#form{{$department->department_id}}')" class="table-action-link"><i class='fa fa-trash-o'></i></a>
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $departments->render() !!}
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