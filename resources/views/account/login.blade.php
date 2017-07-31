@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section style="margin-top: 8em">
		<div id="card-container" class="col-md-4 offset-md-4">

		</div>
		<section id="temp" style="display: none">

				<div data-card="login" class="card">
					<div class="card-block">
					    <div class="form-header primary darken-4">
						        <h3><i class="fa fa-lock"></i> {{__('login')}}</h3>
						    </div>
						<form>
						    <div class="md-form col-md-10">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="text" class="form-control">
						        <label for="form2">{{__('your email')}}</label>
						    </div>

						    <div class="md-form col-md-10">
						        <i class="fa fa-lock prefix"></i>
						        <input type="password" class="form-control">
						        <label for="form4">{{__('your password')}}</label>
						    </div>

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
						<form>
						    <div class="md-form col-md-10">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="text" class="form-control">
						        <label for="form2">{{__('your email')}}</label>
						    </div>

						    <div class="text-center">
						        <button class="btn primary">{{__('send email')}}</button>
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