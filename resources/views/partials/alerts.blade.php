<div class="columns">
    <div class="column is-12">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <strong>@lang('common.success')</strong> {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-error" role="alert">
                <strong>@lang('common.error'):</strong> {{ Session::get('error') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>