@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section style="margin-top: 8em">
		<div id="card-container" class="col-lg-4 offset-lg-4 col-md-10 offset-md-1">

		</div>
		<section id="temp" style="display: none">

				<div data-card="login" class="card">
					<div class="card-block">
					    <div class="form-header primary darken-4">
						        <h3><i class="fa fa-lock"></i> {{__('login')}}</h3>
						    </div>
						<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						    <div class="md-form col-md-10 offset-md-1">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
						        <label>{{__('your email')}}</label>
						    </div>

						    <div class="md-form col-md-10 offset-md-1">
						        <i class="fa fa-lock prefix"></i>
						        <input type="password" name="password" value="{{ old('password') }}" class="form-control" required>
						        <label>{{__('your password')}}</label>
						    </div>

						    <div class="row">
						    <div class="switch">
							    <label>
							      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							      <span class="lever"></span>
							      {{__('remember me')}}
							    </label>
							 </div>    
						    </div>
						    
						    <div class="alert alert-danger" style="display: none"></div>

						    <div class="text-center">
						        <button class="btn primary">{{__('login')}}</button>
						    </div>
					    </form>
					</div>

					<div class="card-footer">
					    <div class="options">
					        {{__('not a member?')}} <a href="#">{{__('sign up')}}</a>
					        <span class="float-right"><a data-type="nav" data-id="forgot" href="#">{{__('forgot password')}}</a></span>
					    </div>
					</div>
				</div>

				<div data-card="forgot" class="card">
					<div class="card-block">

					    <div class="form-header primary darken-4">
						        <h3><i class="fa fa-repeat"></i> {{__('reset password')}}</h3>
						</div>
						@if (session('status'))
	                        <div class="alert alert-success">
	                            {{ session('status') }}
	                        </div>
	                    @endif

						<form method="POST" action="{{ route('password.request') }}">
						{{ csrf_field() }}

						    <div class="md-form col-md-10 col-lg-10">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="email" name="email" class="form-control" required>
						        <label>{{__('your email')}}</label>
						    </div>

						    <div class="alert alert-danger" style="display: none"></div>
						    <div class="text-center">
						        <button type="submit" class="btn primary">{{__('send email')}}</button>
						    </div>
					    </form>

					</div>

					<div class="card-footer">
					    <div class="options">
					        <a data-type="nav" data-id="login" href="#">{{__('go back')}}</a>
					        <span class="float-right">{{__('not a member?')}} <a href="#">{{__('sign up')}}</a></span>
					    </div>
					</div>
				</div>

		</section>
	</section>
@endsection

@section ('js')
<script type="text/javascript">
	loginScript.init()
</script>
@endsection