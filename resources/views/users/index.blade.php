@extends('layouts.app')
@section('htmlheader_title')
@endsection

@section('content')
   <div class="container">
       <div class="columns">
           <div class="column is-12">
               @include('partials.alerts')
           </div>
       </div>
       <div class="columns">
           <div class="column is-6">
               <nav class="breadcrumb has-arrow-separator" aria-label="breadcrumbs">
                   <ul>
                       <li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true">&nbsp;</i>{{ @Lang::get('common.home') }}</a></li>
                       <li><a><i class="fa fa-gears" aria-hidden="true">&nbsp;</i>{{ @Lang::get('users.settings') }}</a></li>
                       <li class="is-active"><a href="{{ route('users.index') }}" aria-current="page"><i class="fa fa-users" aria-hidden="true">&nbsp;</i>{{ @Lang::get('users.all_users') }}</a></li>
                   </ul>
               </nav>
           </div>
           <div class="column is-6">
               <a href="{{ route('users.create') }}" class="button is-primary m-r pull-right">{{ Lang::get('users.create_new') }}</a>
           </div>
       </div>
       <div class="is-12">
           <hr>
       </div>
       <div class="card">
           <div class="card-content">
               <table class="table is-narrow">
                   <thead>
                       <th class="text-center">#</th>
                       <th>{{ Lang::get('users.name') }}</th>
                       <th>{{ Lang::get('users.email') }}</th>
                       <th>{{ Lang::get('users.client') }}</th>
                       <th>{{ Lang::get('users.department') }}</th>
                       <th>{{ Lang::get('users.position') }}</th>
                       <th></th>
                   </thead>
                   <tbody>
                       @foreach($users as $user)
                           <tr>
                               <th class="text-center">{{ $user->id }} </th>
                               <td> {{ $user->name }} </td>
                               <td> {{ $user->email }} </td>
                               <td> {{ $user->client_id }} </td>
                               <td>jopa</td>
                               <td>jopa</td>
                               {{--<td> {{ $user->department->department_name }} </td>--}}
                               {{--<td> {{ $user->position->position_name }} </td>--}}
                               <td class="text-center" style="">
                                   @if ($user->hasAccessTo('user', 'edit', 0))
                                       <a href="{{ route('users.edit', $user->id) }}" id="user_edit" class="table-action-link m-r"><i class='fa fa-pencil'></i></a>
                                   @endif
                                   @if ($user->hasAccessTo('partner', 'delete', 0))
                                       {!! Form::open(['route' => ['users.destroy', $user->id], 'id' => 'form'.$user->id, 'style' => 'max-width: 32px; margin:0; display: inline; float: none;', 'method' => 'DELETE']) !!}
                                           <a href="javascript: submitform('#form{{$user->id}}')" class="table-action-link"><i class='fa fa-trash-o'></i></a>
                                       {!! Form::close() !!}
                                   @endif
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
               <div class="text-center">
                   {!! $users->render() !!}
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
