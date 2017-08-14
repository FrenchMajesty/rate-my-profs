@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
		
	<div class="row marg-navbar">
        @include ('partials.side-module')
        <div class="col-md-8 scrollable">
            <div class="card professor-details">
                <div class="row">
                    <div class="overall-rating col-md-4">
                        <div class="card-block">             
                            <i class="material-icons smiley green-text">tag_faces</i>
                            <section class="row rating">
                                <h1 class="score green-text">
                                @if($total) {{ number_format($total['overall'],1) }} 
                                @else --
                                @endif
                                </h1> <span>{{__('avg rating')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="score green-text">
                                @if($total) {{ number_format($total['difficulty'],1) }}
                                @else --
                                @endif
                                </h1> <span>{{__('avg difficulty')}}</span>
                            </section>
                        </div>
                    </div>

                     <div class="more-details col-md-4">
                        <div class="card-block">
                            <h2>{{ $professor->name }},<br> {{ $professor->lastname }}</h2>
                            <p>
                            {{__('prof of')}} {{ strtolower($department) }}
                            at <a href="{{ route('school.view') }}/{{ $school->id }}">{{ $school->name }}</a>, {{ $school->location }}.</p>
                        </div>
                        <a href="{{route('register')}}" class="self-identify">{{__('are you :name', ['name' => $professor->name])}}</a><br>
                        <a class="school-website" data-toggle="modal" data-target="#submitCorrection" href="#">{{__('submit correction')}}</a>
                    </div>
                     <div class="colleagues col-md-4">
                        <div class="card-block">
                            <h4>{{ $school->name }}</h4>
                            <span>{{__('located in :location',['location' => $school->location])}}.</span>
                            <p>
                            @if($similar['school'] > 0)
                                <a href="#">
                                    {{__('check out :count profs at school', ['count' => $similar['school']])}}
                                </a>
                            @else
                                <span class="no-links">{{__('no other prof in this school')}}.</span>
                            @endif</p>
                            <div class="dropdown-divider"></div><br>
                            <span>{{__('prof in dep of')}}</span>
                            <b>{{ $department }}</b>
                            <p>
                            @if($similar['dept'] > 0)
                                <a href="#">
                                {{__('check out :count profs at department', ['count' => $similar['dept']])}}
                                </a>
                            @else
                                <span class="no-links">{{__('no other prof in this dept')}}.</span>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-reviews">
                <div class="card-block">
                    <h4 class="card-title">{{__('student reviews')}}

                    @if(count($ratings) > 0)
                        <span class="float-r">
                        <button class="btn amber" data-toggle="modal" data-target="#rateProfessor">{{__('rate this prof')}}</button>
                        </span>
                    @endif
                    </h4>
                    @if(count($ratings) > 0)
                        @foreach ($ratings as $rating)
                        <?php $class = json_decode($rating->class_details, true); ?>
                            <div class="reviews-container" data-id="{{ $rating->id }}" data-prof="{{ $rating->prof_id }}">
                                <section class="card review">
                                    <div class="row">
                                        <div class="rating-box col-md-2">
                                            {{__('rating')}}<br>
                                            <h3>{{ $rating->overall_rating }}</h3>
                                            {{__('difficulty')}}<br>
                                            <h3>{{ $rating->difficulty_rating }}</h3>
                                        </div>
                                        <div class="comment col-md-10 row">
                                            <div class="class-info col-md-3">
                                            <h5>{{__('class')}}: {{ $class['code'] }}</h5><br>
                                            <p><b>{{__('txtbook used')}}</b>: {{__($class['textbook'] ? 'yes' : 'no')}}</p>
                                            <p><b>{{__('would take again')}}</b>: {{__($class['retake'] ? 'yes' : 'no')}}</p>
                                            <p><b>{{__('grade received')}}</b>: {{ $class['grade'] }} </p>
                                            </div>
                                            <div data-id="comment" class="col-md-9" style="position: relative;">
                                                <span>{{ $rating->comment }}</span>
                                                <section class="like-buttons row">
                                                    <a href="#" class="vote-up marg-right-2">
                                                        {{__(':count ppl found helpful', ['count' => $rating->upvote])}} 
                                                        <i class="material-icons vote-up">thumb_up</i>
                                                    </a>
                                                    <a href="#" class="vote-down">
                                                        {{__(':count ppl found unhelpful', ['count' => $rating->downvote])}} 
                                                        <i class="material-icons vote-down">thumb_down</i>
                                                    </a>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <li class="comment-date"><i class="fa fa-clock-o"></i>{{ date('d M Y',strtotime($rating->created_at)) }}</li>
                                        <a data-id="report" data-toggle="modal" data-target="#reportRating" class="float-right" href="#">{{__('report rating')}} </a>
                                    </div>
                                </section>
                            </div>
                        @endforeach
                        <div class="row marg-top-2">
                            <button class="btn amber mx-auto" data-toggle="modal" data-target="#rateProfessor">{{__('rate this prof')}}</button>
                        </div>
                    @else
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-block text-center">
                                    <h4 class="black-text">{{__('no ratings for this prof yet')}}</h4>
                                    <button class="btn amber mx-auto">
                                        {{__('be the first')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="submitCorrection" tabindex="-1" role="dialog" aria-labelledby="{{__('prof.correct')}}" aria-hidden="true">
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

            <form method="POST" action="{{route('prof.correction')}}">
            {{ csrf_field() }}
            <input type="hidden" name="prof_id" value="{{ $professor->id }}">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                        <p>{{__(':name, prof in :dept at :school, :location', [
                        'name' => $professor->name, 'dept' => $department, 'school' => $school->name,
                        'location' => $school->location])}}</p>
                    </div>
                    <section class="col-md-10 marg-top-3">
                        <div class="md-form">
                            <textarea type="text" name="problem" class="md-textarea" required></textarea>
                            <label>{{__('whats the problem')}}</label>
                        </div>
                        <div class="md-form">
                            <input type="email" name="email" class="form-control" required>
                            <label>{{__('your email')}}</label>
                        </div>
                    </section>
                </div>
                <div class="alert alert-danger" style="display: none"></div>

                <!-- Add captcha here -->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary-modal">{{__('submit')}}</i></button>
                    <button class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">{{__('cancel')}}</button>
                </div>
            </form>
        </div>
        <!--/.Content-->
        </div>
    </div>

    <div class="modal fade" id="reportRating" tabindex="-1" role="dialog" aria-labelledby="{{__('report this rating')}}" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-warning modal-side modal-top-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">{{__('report rating')}}</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('prof.reportRating')}}">
            {{ csrf_field() }}
            <input type="hidden" name="rating_id">
            <input type="hidden" name="type" value="prof">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                        <p></p>
                    </div>
                    <section class="col-md-10 marg-top-3">
                        <div class="md-form">
                            <textarea type="text" name="issue" class="md-textarea" required></textarea>
                            <label>{{__('whats wrong with rating')}}</label>
                        </div>
                    </section>
                </div>
                <div class="alert alert-danger" style="display: none"></div>

                <!-- Add captcha here -->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary-modal">{{__('submit')}}</i></button>
                    <button class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">{{__('cancel')}}</button>
                </div>
            </form>
        </div>
        <!--/.Content-->
        </div>
    </div>

    <div class="modal fade" id="rateProfessor" tabindex="-1" role="dialog" aria-labelledby="{{__('rate this prof')}}" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-lg modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">{{__('rate this prof')}}</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{route('prof.rate')}}">
            {{ csrf_field() }}
            <input type="hidden" name="prof_id" value="{{ $professor->id }}">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-star fa-4x mb-1 animated rotateIn"></i>
                        <p>{{__(':name, prof in :dept at :school, :location', [
                        'name' => $professor->name, 'dept' => $department, 'school' => $school->name,
                        'location' => $school->location])}}</p>
                    </div>
                    <section class="col-md-10 marg-top-3">
                        <div class="row">
                            <div class="col-md-4 offset-md-2">
                                <div class="md-form">
                                    <input type="text" class="form-control" name="class_code" value="{{old('class_code')}}" placeholder="{{__('class code eg')}}" required>
                                    <label>{{__('your class code')}}</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="class_grade" value="{{old('class_grade')}}" autocomplete="off" required>
                                    <label>{{__('your grade earned')}}</label>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-2">
                                {{__('would take again')}}?
                                <div class="switch">
                                    <label>
                                      {{__('no')}}
                                      <input type="checkbox" name="retake">
                                      <span class="lever"></span>
                                      {{__('yes')}}
                                    </label>
                                </div>

                                {{__('textbook used')}}?
                                <div class="switch">
                                    <label>
                                      {{__('no')}}
                                      <input type="checkbox" name="textbook">
                                      <span class="lever"></span>
                                      {{__('yes')}}
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="range-field">
                                    {{__('overall rating')}} (<span data-id="overall">3</span>)
                                    <input type="range" name="overall" value="{{old('overall')}}" min="0" max="5" step="0.5" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="range-field">
                                    {{__('class difficulty')}} (<span data-id="difficulty">3</span>)
                                    <input type="range" name="difficulty" value="{{old('difficulty')}}" min="0" max="5" step="0.5" required />
                                </div>
                            </div>
                        </div><br>
                        <div class="md-form">
                            <textarea type="text" name="comment" class="md-textarea" length="350" maxlength="350" required>{{old('comment')}}</textarea>
                            <label>{{__('your chance to be more specific')}}</label>
                        </div>
                        <div class="alert alert-danger" style="display: none"></div>
                    </section>
                </div>

                <!-- Add captcha here -->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary-modal">{{__('submit rating')}}</i></button>
                    <button class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">{{__('cancel')}}</button>
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
        const config = {
            successRate: {
                message: '{{__('rating sucessfully sent')}}',
                redirectUrl: '{{route('prof.view')}}/{{ $professor->id }}'
            },
            settings: {
                voteUrl: '{{route('prof.rateRating')}}'
            }
        }
        professorView.init(config)
        sideModule.init('similar')
    })
    </script>
@endsection