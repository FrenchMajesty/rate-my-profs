@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
		
	<div class="row" style="margin-top: 5em">
        @include ('partials.side-module')
        <div class="col-md-8 scrollable">
            <div class="card professor-details">
                <div class="row">
                    <div class="overall-rating col-md-4">
                        <div class="card-block">               
                            <i class="material-icons smiley green-text">tag_faces</i>
                            <section class="row rating">
                                <h1 class="score green-text">5.0</h1> <span>{{__('avg rating')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="score green-text">4.5</h1> <span>{{__('avg difficulty')}}</span>
                            </section>
                        </div>
                    </div>

                     <div class="more-details col-md-4">
                        <div class="card-block">
                            <h2>{{ $professor->name }},<br> {{ $professor->lastname }}</h2>
                            <p>
                            {{__('prof of')}} {{ strtolower($department) }}
                            at <a href="{{ route('view.school') }}/{{ $school->id }}">{{ $school->name }}</a>, {{ $school->location }}.</p>
                        </div>
                        <a href="#" class="self-identify">{{__('are you :name', ['name' => 'Donald'])}}</a><br>
                        <a class="school-website" data-toggle="modal" data-target="#submitCorrection" href="#">{{__('submit correction')}}</a>
                    </div>
                     <div class="colleagues col-md-4">
                        <div class="card-block">
                            <h4>{{ $school->name }}</h4>
                            <span>{{__('located in :location',['location' => $school->location])}}.</span>
                            <p><a href="#">{{__('check out :count profs at school', ['count' => 7])}}</a></p>
                            <div class="dropdown-divider"></div><br>
                            <span>{{__('prof in dep of')}}</span>
                            <b>{{ $professor->department }}</b>
                            <p><a href="#">{{__('check out :count profs at department', ['count' => 4])}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-reviews">
                <div class="card-block">
                    <h4 class="card-title">{{__('student reviews')}}<span class="float-r">
                        <button class="btn btn-primary primary">{{__('rate this prof')}}</button>
                    </span></h4>

                    <div class="reviews-container">
                        <section class="card review">
                            <div class="row">
                                <div class="rating-box col-md-2">
                                    {{__('rating')}}<br>
                                    <h3>5</h3>
                                    {{__('difficulty')}}<br>
                                    <h3>3.5</h3>
                                </div>
                                <div class="comment col-md-10 row">
                                    <div class="class-info col-md-3">
                                    <h5>{{__('class')}}: MATH2018</h5><br>
                                    <p><b>{{__('txtbook used')}}</b>: {{__('no')}}</p>
                                    <p><b>{{__('would take again')}}</b>: {{__('yes')}}</p>
                                    <p><b>{{__('grade received')}}</b>: B+</p>
                                    </div>
                                    <div class="col-md-9">
                                        Most amazing, caring teacher. She goes out of her way to help her students pass, but you do have to put in the effort and time. I hate math and it hates me back, it is very challenging for me. Her encouragement and is the only thing that kept me going and I passed. Thank you , Thank you Vicki Gatewood!!!
                                        <section class="like-buttons row">
                                            <a href="#" class="vote-up">
                                                {{__(':count ppl found helpful', ['count' => 3])}} 
                                                <i class="material-icons">thumb_up</i>
                                            </a>
                                            <a href="#" class="vote-down">
                                                {{__(':count ppl found unhelpful', ['count' => 0])}} 
                                                <i class="material-icons">thumb_down</i>
                                            </a>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <li class="comment-date"><i class="fa fa-clock-o"></i> 08/10/2015</li>
                                <a class="float-right" href="#">{{__('report rating')}} </a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="submitCorrection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-warning modal-side modal-top-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">{{__('submit correction')}}</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                        <p>{{__(':name, prof in :dept at :school, :location', [
                        'name' => 'Donald Trump', 'dept' => 'Mathematics', 'school' => 'Harvard University',
                        'location' => 'Cambridge, MA'])}}</p>
                    </div>
                    <section class="col-md-10 marg-top-3">
                        <div class="md-form">
                            <textarea type="text" class="md-textarea"></textarea>
                            <label>{{__('whats the problem')}}</label>
                        </div>
                        <div class="md-form">
                            <input type="text" class="form-control">
                            <label>{{__('your email')}}</label>
                        </div>
                    </section>
                </div>

                <!-- Add captcha here -->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary-modal">{{__('submit')}}</i></button>
                    <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">{{__('cancel')}}</a>
                </div>
            </form>
        </div>
        <!--/.Content-->
        </div>
    </div>

@endsection

@section ('footer')
    @include ('partials.footer')
@endsection

@section ('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(() => {
        sideModule.init('similar')
    })
    </script>
@endsection