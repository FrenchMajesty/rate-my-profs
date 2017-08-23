@extends ('layout')

@section ('navbar')
    @include ('partials.navbar')
@endsection

@section ('content')
    <section style="margin-top: 8em">
        <div id="card-container" class="col-lg-4 offset-lg-4 col-md-10 offset-md-1">
            <div data-card="login" class="card">
                    <div class="card-block">
                        <div class="form-header primary darken-4">
                                <h3><i class="fa fa-user"></i> {{__('reset password')}}</h3>
                            </div>
                        <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                            <div class="md-form col-md-10 offset-md-1">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                <label>{{__('your email')}}</label>
                            </div>

                            <div class="md-form col-md-10 offset-md-1">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="password" class="form-control" required>
                                <label>{{__('your password')}}</label>
                            </div>

                            <div class="md-form col-md-10 offset-md-1">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="password_confirmation" class="form-control" required>
                                <label>{{__('confirm password')}}</label>
                            </div>
                            
                            <div class="alert alert-danger" style="display: none"></div>

                            <div class="text-center">
                                <button type="submit"class="btn primary">{{__('reset password')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
@endsection

@section ('js')
<script type="text/javascript" src="{{asset('js/custom-auth.js')}}"></script>
<script type="text/javascript">
    resetPasswordScript.init()
</script>
@endsection