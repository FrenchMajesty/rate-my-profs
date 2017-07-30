@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
		
	<div class="row" style="margin-top: 5em">

        @include ('partials.side-module')

        <div id="page-content" class="col-md-8">
            <div class="card school-details">
                <div class="row">

                    <div class="overall-rating col-md-4">
                        <div class="card-block">
                            <section class="row rating">
                                <h1 class="green-text">4.2</h1> <span>{{__('location')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">4.5</h1> <span>{{__('facilities')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">3.9</h1> <span>{{__('opportunity')}}</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">3.0</h1> <span>{{__('social')}}</span>
                            </section>
                        </div>
                    </div>

                     <div class="more-details col-md-4">
                        <div class="card-block">                           
                            <h2>Harvard University</h2>
                            <p>Cambridge, MA.</p>
                            <a class="school-website" href="#">{{__('website')}}</a>
                            <button class="col-md-12 btn btn-primary primary marg-top-5">
                        {{__('rate this school')}}
                        </button>
                        <a class="school-website" href="#">{{__('submit correction')}}</a>
                        </div>
                    </div>

                     <div class="about-profs col-md-4">
                        <div class="card-block">
                            <h4 class="card-title">{{__('top profs')}}</h4>
                            <ul class="top-professor">
                                <li>
                                    <a href="#">Federick Roosevelt</a><div class="float-right">5.0</div>
                                    <br><label>{{__(':count reviews',['count' => 94])}}</label>
                                </li>
                                <li>
                                    <a href="#">Abraham Lincoln</a><div class="float-right">5.0</div>
                                    <br><label>{{__(':count reviews',['count' => 193])}}</label>
                                </li>
                                <li>
                                    <a href="#">Harry Truman</a><div class="float-right">4.9</div>
                                    <br><label>{{__(':count reviews',['count' => 53])}}</label>
                                </li>
                            </ul>
                            <div class="text-center">
                                <button class="btn btn-primary primary">
                                    {{__('view all')}}
                                </button> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-reviews">
                <div class="card-block">
                    <h4 class="card-title">{{__('student reviews')}}</h4>

                    <div class="reviews-container">
                        <section class="card review">
                            <div class="row">
                                <ul class="rating-box col-md-2">

                                <li class="score">
                                    <span class="score-value">4</span> <span class="score-type">{{__('location')}}</span>
                                </li> 
                                <li class="score">
                                    <span class="score-value">4</span> <span class="score-type">{{__('facilities')}}</span>
                                </li>
                                <li class="score">
                                    <span class="score-value">2</span> <span class="score-type">{{__('opportunity')}}</span>
                                </li>
                                <li class="score">
                                    <span class="score-value">5</span> <span class="score-type">{{__('social')}}</span>
                                </li>  
                                </ul>
                                <div class="comment col-md-10">
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
                            <div class="card-footer">
                                <li class="comment-date"><i class="fa fa-clock-o"></i> 08/10/2015</li>
                                <a class="float-right" href="#">{{__('report rating')}}</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
@endsection