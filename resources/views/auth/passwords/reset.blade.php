@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="notification is-success">
        {{ session('status') }}
    </div>
@endif

<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-100">
        <div class="card">
            <div class="card-content">
                <h1 class="title">Reset Your Password</h1>
                <form action="{{ route('password.request') }}" method="POST" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="field">
                        <label for="name" class="label">Name</label>
                        <p class="control">
                            <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
                        </p>
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">{{$errors->first('name')}}</p>
                    @endif
                    <div class="field">
                        <label for="email" class="label">Email Address</label>
                        <p class="control">
                            <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                        </p>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{$errors->first('email')}}</p>
                    @endif
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label for="password" class="label">Password</label>
                                <p class="control">
                                    <input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" id="password" required>
                                </p>
                            </div>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>

                        <div class="column">
                            <div class="field">
                                <label for="password_confirmation" class="label">Confirm Password</label>
                                <p class="control">
                                    <input class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" type="password" name="password_confirmation" id="password_confirmation" required>
                                </p>
                            </div>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                    </div>

                    <button class="button is-primary is-outlined is-fullwidth m-t-30">Reset Password</button>
                </form>
            </div> <!-- end of .card-content -->
        </div> <!-- end of .card -->
        <h5 class="has-text-centered m-t-20"><a href="{{ route('login') }}" class="is-muted">Already have an Account</a></h5>
    </div>
</div>
@endsection
