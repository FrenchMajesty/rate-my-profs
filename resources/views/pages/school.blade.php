@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
		
	<div class="row marg-navbar">

        @include ('partials.side-module')

        <div class="col-md-8 scrollable">
            <div class="card school-details">
                <div class="row">

                    <div class="overall-rating col-md-4">
                        <div class="card-block">
                        @if($total)
                            <section class="row rating">
                                <h1 class="green-text">{{number_format($total['overall'],1)}}</h1> <span>{{__('overall rating')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">{{number_format($total['location'], 1)}}</h1> <span>{{__('location')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">{{number_format($total['facility'], 1)}}</h1> <span>{{__('facilities')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">{{number_format($total['opportunity'], 1)}}</h1> <span>{{__('opportunity')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">{{number_format($total['social'], 1)}}</h1> <span>{{__('social')}}</span>
                            </section>
                        @else
                            <div class="text-center" style="transform: translateY(100%);">
                                <p>{{__('no ratings for this school yet')}}</p>
                            </div>
                        @endif
                        </div>
                    </div>

                     <div class="more-details col-md-4">
                        <div class="card-block">                           
                            <h2>{{ $school->name }}</h2>
                            <p>{{ $school->location }}</p>
                            <a class="school-website" href="{{$school->website}}" target="_blank">{{__('website')}}</a>
                            <button data-toggle="modal" data-target="#rateSchool" class="col-md-12 btn primary marg-top-5">
                                {{__('rate this school')}}
                            </button>
                        <a class="school-website" data-toggle="modal" data-target="#submitCorrection" href="#">{{__('submit correction')}}</a>
                        </div>
                    </div>

                     <div class="about-profs col-md-4">
                        <div class="card-block">
                            <h4 class="card-title">{{__('top profs')}}</h4>
                            @if(count($top) > 0)
                            <ul class="top-professor">
                                @foreach($top as $prof)
                                <li>
                                    <a href="{{route('prof.view', [$prof->id])}}">{{$prof->name}}</a>
                                    <div class="float-right">
                                        {{ is_numeric($prof->average) ? number_format($prof->average, 1) : '--' }}
                                    </div>
                                    <br><label>{{__(':count reviews',['count' => $prof->reviews_count])}}</label>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center">
                                @if(count($top) > 3)
                                    <a href="#" class="btn primary">
                                        {{__('view all')}}
                                    </a> 
                                @else
                                    <a href="{{route('add.prof')}}" class="btn btn-primary">
                                        {{__('add your prof')}}
                                    </a>
                                @endif 
                            </div>
                            @else
                                <div class="text-center">
                                <p>{{__('no profs at this school')}}.</p>
                                    <a href="{{route('add.prof')}}" class="btn btn-default">{{__('add your prof')}}!</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-reviews">
                <div class="card-block">
                    <h4 class="card-title">{{__('student reviews')}}</h4>

                    @if(count($ratings) > 0)
                    <div class="reviews-container">
                        @foreach($ratings as $rating)
                        <rating class="card review" data-id="{{ $rating->id }}" data-school="{{ $rating->school_id }}">
                            <div class="row">
                                <ul class="rating-box col-md-2">

                                <li class="score">
                                    <span class="score-value">{{$rating->overall_rating}}</span> <span class="score-type">{{__('overall')}}</span>
                                </li> 
                                <li class="score">
                                    <span class="score-value">{{$rating->location}}</span> <span class="score-type">{{__('location')}}</span>
                                </li> 
                                <li class="score">
                                    <span class="score-value">{{$rating->facility}}</span> <span class="score-type">{{__('facilities')}}</span>
                                </li>
                                <li class="score">
                                    <span class="score-value">{{$rating->opportunity}}</span> <span class="score-type">{{__('opportunity')}}</span>
                                </li>
                                <li class="score">
                                    <span class="score-value">{{$rating->social}}</span> <span class="score-type">{{__('social')}}</span>
                                </li>  
                                </ul>
                                <div class="comment col-md-10">
                                    <span>{{$rating->comment}}</span>
                                    <section class="like-buttons row">
                                        <a href="#" class="vote-up marg-right-2">
                                            {{__(':count ppl found helpful', ['count' => $rating->upvote])}}
                                            <i class="material-icons">thumb_up</i>
                                        </a>
                                        <a href="#" class="vote-down">
                                            {{__(':count ppl found unhelpful', ['count' => $rating->downvote])}}
                                            <i class="material-icons">thumb_down</i>
                                        </a>
                                    </section>
                                </div>
                            </div>
                            <div class="card-footer">
                                <li class="comment-date"><i class="fa fa-clock-o"></i> {{ date('d M Y',strtotime($rating->created_at)) }}</li>
                                <a class="float-right" href="#" data-id="report" data-toggle="modal" data-target="#reportRating">{{__('report rating')}}</a>
                            </div>
                        </rating>
                        @endforeach
                        <div class="row marg-top-2">
                            <button class="btn amber mx-auto waves-effect waves-light" data-toggle="modal" data-target="#rateSchool">{{__('rate this school')}}</button>
                        </div>
                    </div>
                    @else
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-block text-center">
                                    <h4 class="black-text">{{__('no ratings for this school yet')}}</h4>
                                    <button class="btn amber mx-auto" data-toggle="modal" data-target="#rateSchool">
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
<div class="modal fade" id="submitCorrection" tabindex="-1" role="dialog" aria-labelledby="{{__('submit correction')}}" aria-hidden="true">
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

            <form method="POST" action="{{route('school.correction')}}">
            {{ csrf_field() }}
            <input type="hidden" name="school_id" value="{{$school->id}}">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                        <p>{{__(':school at :location', ['school' => $school->name, 'location' => $school->location])}}</p>
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
            <form method="POST" action="{{route('school.reportRating')}}">
            {{ csrf_field() }}
            <input type="hidden" name="rating_id">
            <input type="hidden" name="type" value="school">
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

<div class="modal fade" id="rateSchool" tabindex="-1" role="dialog" aria-labelledby="{{__('rate this school')}}" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-lg modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <p class="heading lead">{{__('rate this school')}}</p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>

        <form method="POST" action="{{route('school.rate')}}">
        {{ csrf_field() }}
        <input type="hidden" name="school_id" value="{{ $school->id }}">
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-star fa-4x mb-1 animated rotateIn"></i>
                    <p>{{__(':school at :location', ['school' => $school->name, 'location' => $school->location])}}</p>
                </div>
                <section class="col-md-10 offset-md-1 marg-top-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="range-field">
                                {{__('overall rating')}} (<span data-id="overall">3</span>)
                                <input type="range" name="overall" min="0" max="5" step="0.5" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="range-field">
                                {{__('location')}} (<span data-id="location">3</span>)
                                <input type="range" name="location" min="0" max="5" step="0.5" required />
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="range-field">
                                {{__('facilities')}} (<span data-id="facilities">3</span>)
                                <input type="range" name="facilities" min="0" max="5" step="0.5" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="range-field">
                                {{__('opportunity')}} (<span data-id="opportunity">3</span>)
                                <input type="range" name="opportunity" min="0" max="5" step="0.5" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="range-field">
                                {{__('social')}} (<span data-id="social">3</span>)
                                <input type="range" name="social" min="0" max="5" step="0.5" required />
                            </div>
                        </div>
                    </div><br>
                    <div class="md-form">
                        <textarea type="text" name="comment" class="md-textarea" maxlength="350" required></textarea>
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
                message: '{{__('rating successfully sent')}}'
            },
            url: {
                vote: '{{route('school.rateRating')}}'
            }
        }
        schoolView.init(config)
        sideModule.init('school')
    })
    </script>
@endsection