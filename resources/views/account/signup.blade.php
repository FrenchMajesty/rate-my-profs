@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section style="margin-top: 8em">
		<div class="row">
			<div class="col-md-4 offset-md-1 mt-1 hidden-sm-down">
	            <h1>{{__('why sign up')}}</h1>

	            <ul data-id="student" class="advantages-list">
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('find profs faster')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span> {{__('set preferences')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('access your recent searches')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('comparing profs')}}</li>
	                <li>...{{__('and')}} {{__('still anonymous')}}</li>
	            </ul>
	            <ul data-id="prof" class="advantages-list" style="display: none">
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('customize your url')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span> {{__('add photo or twitter')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('add class note')}}</li>
	                <li><span class="green-text"><i class="fa fa-check"></i></span>{{__('receive alerts')}}</li>
	                <li>...{{__('and')}} {{__('let student know you care')}}</li>
	            </ul>
	            <div class="switch marg-top-5">
				    <label style="font-size: 1.2em">
				      {{__('im a stud')}}
				      <input type="checkbox">
				      <span class="lever"></span>
				      {{__('im a prof')}}
				    </label>
				 </div>                
	        </div>
			<div id="signup-container" class="col-md-4 offset-md-1">
			</div>
			</div>
	</section>
	<section style="display: none">
		<div data-card="student" class="card">
			<div class="card-block">

			    <div class="form-header primary darken-4">
			        <h3><i class="fa fa-user-plus"></i> {{__('sign up')}}</h3>
			    </div>
			    <form>
			    	<div class="md-form">
				        <i class="fa fa-user prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('first name')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-user prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('last name')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-envelope prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('email')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-envelope prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('confirm email')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-lock prefix"></i>
				        <input type="password" class="form-control">
				        <label >{{__('Password')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-lock prefix"></i>
				        <input type="password" class="form-control">
				        <label>{{__('confirm password')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-graduation-cap prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('school')}} ({{__('optional')}})</label>
				    </div>

				    <!-- add captcha and TOS -->
				    <div class="text-center">
				        <button class="btn primary">{{__('sign up')}}</button>
				    </div>
			    </form>
			</div>

			<div class="modal-footer">
			    <div class="options">
			        <p>{{__('already a member?')}} <a href="#">{{__('sign in here')}}</a></p>
			    </div>
			</div>
		</div>
		<div data-card="prof" class="card">
			<div class="card-block">

			    <div class="form-header primary darken-4">
			        <h3><i class="fa fa-user-plus"></i> {{__('sign up')}}</h3>
			    </div>
			    <form>
			    	<div class="md-form">
				        <i class="fa fa-user prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('your name')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-envelope prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('email')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-envelope prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('confirm email')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-lock prefix"></i>
				        <input type="password" class="form-control">
				        <label >{{__('Password')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-lock prefix"></i>
				        <input type="password" class="form-control">
				        <label>{{__('confirm password')}}</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-graduation-cap prefix"></i>
				        <input type="text" class="form-control">
				        <label>{{__('faculty directory listing')}}</label>
				    </div>

				    <!-- add captcha and terms of use -->
				    <div class="text-center">
				        <button class="btn primary">{{__('sign up')}}</button>
				    </div>
			    </form>
			</div>

			<div class="modal-footer">
			    <div class="options">
			        <p>{{__('already a member?')}} <a href="#">{{__('sign in here')}}</a></p>
			    </div>
			</div>
		</div>
	</section>
@endsection

@section ('js')
<script type="text/javascript">
signUp.init()
</script>
@endsection