@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<div class="row marg-navbar">
		<section class="col-md-10 offset-md-1 marg-top-2">
			<div class="card">
			<div class="card-block">
                <div class="form-header primary darken-4">
                	<h3><i class="fa fa-user"></i> {{__('my account')}}</h3>
                </div>
            	<div class="row">
                	<section class="col-md-6">
                		<form action="{{route('profile.details')}}">
                			{{ csrf_field() }}
                			<?php 
                			$user = Auth::user();
                			$name = explode(' ', $user->name); ?>
                			<input type="hidden" name="id" value="{{$user->id}}">
                			<div class="md-form">
                                <i class="fa fa-male prefix"></i>
                                <input type="text" name="firstname" class="form-control" placeholder="{{__('your first name')}}" value="{{$name[0]}}" required>
                            </div>
                            <div class="md-form">
                                <i class="fa fa-male prefix"></i>
                                <input type="text" name="lastname" class="form-control" placeholder="{{__('your last name')}}" value="{{$name[1]}}" required>
                            </div>
                            <div class="md-form">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" name="email" class="form-control" placeholder="{{__('your email')}}" value="{{$user->email}}" required>
                            </div>
                            <section class="error"></section>
                             <div class="text-center">
                                <button type="submit" class="col-md-12 btn primary">{{__('update details')}}</button>
                            </div>
                        </form>
                    </section>
                    <section class="col-md-6">
                    	<form action="{{route('profile.password')}}">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="id" value="{{$user->id}}">
                    	<div class="md-form">
                            <i class="fa fa-lock prefix"></i>
                            <input type="password" name="password" placeholder="{{__('new password')}}" class="form-control" required>
                            <label>{{__('new password')}}</label>
                        </div>

                        <div class="md-form">
                            <i class="fa fa-lock prefix"></i>
                            <input type="password" name="password_confirmation" placeholder="{{__('confirm password')}}" class="form-control" required>
                            <label>{{__('confirm password')}}</label>
                        </div>

                		<section class="error"></section>
                         <div class="text-center">
                            <button type="submit" class="col-md-12 btn primary">{{__('update password')}}</button>
                        </div>
                        </form>
                    </section>
                </div>
            </div>
            </div>
        </section>
	</div>
	<!--div class="row">
		<section class="col-md-6">
			<h4></h4>
		</section>
	</div-->
@endsection

@section ('footer')
    @include ('partials.footer')
@endsection

@section ('js')
<script type="text/javascript">
	$(document).ready(() => {
		const config = {
			message: { 
				details: '{{__('profile successfully updated')}}', 
				password: '{{__('password successfully updated')}}'
			}
		}
		userProfile.init(config)
	})
</script>
@endsection