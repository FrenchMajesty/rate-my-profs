@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
		
	<div class="row" style="margin-top: 5em">
        @include ('partials.side-module')
        <div id="page-content" class="col-md-8">
            <div class="card professor-details">
                <div class="row">
                    <div class="overall-rating col-md-4">
                        <div class="card-block">               
                            <i class="material-icons smiley green-text">tag_faces</i>
                            <section class="row rating">
                                <h1 class="score green-text">5.0</h1> <span>Average Rating</span>
                            </section>
                            <section class="row rating">
                                <h1 class="score green-text">4.5</h1> <span>Average Difficulty</span>
                            </section>
                        </div>
                    </div>
                     <div class="more-details col-md-4">
                        <div class="card-block">
                            <h2>Trump,<br> Donald</h2>
                            <p>Professor of Mathematics and Politics at <a href="#">Havard University</a>, Cambridge, MA.</p>
                        </div>
                        <a href="#" class="self-identify">Are you Donald?</a>
                    </div>
                     <div class="colleagues col-md-4">
                        <div class="card-block">
                            <h4>Harvard University</h4>
                            <span>Located in Cambrige, MA.</span>
                            <p><a href="#">Check out the other 7 professors from this school</a></p>
                            <div class="dropdown-divider"></div><br>
                            <span>Professor in the department of</span>
                            <b>Mathematics and Politics</b>
                            <p><a href="#">Check out the other 4 professors from this department</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-reviews">
                <div class="card-block">
                    <h4 class="card-title">Student reviews <span class="float-r">
                        <button class="btn btn-primary primary">Rate this professor</button>
                    </span></h4>

                    <div class="reviews-container">
                        <section class="card review">
                            <div class="row">
                                <div class="rating-box col-md-2">
                                    Rating<br>
                                    <h3>5</h3>
                                    Difficulty<br>
                                    <h3>3.5</h3>
                                </div>
                                <div class="comment col-md-10">
                                    Most amazing, caring teacher. She goes out of her way to help her students pass, but you do have to put in the effort and time. I hate math and it hates me back, it is very challenging for me. Her encouragement and is the only thing that kept me going and I passed. Thank you , Thank you Vicki Gatewood!!!
                                </div>
                            </div>
                        </section>
                        <section class="card review">
                            <div class="row">
                                <div class="rating-box col-md-2">
                                    Rating<br>
                                    <h3>5</h3>
                                    Difficulty<br>
                                    <h3>3.5</h3>
                                </div>
                                <div class="comment col-md-10">
                                    Most amazing, caring teacher. She goes out of her way to help her students pass, but you do have to put in the effort and time. I hate math and it hates me back, it is very challenging for me. Her encouragement and is the only thing that kept me going and I passed. Thank you , Thank you Vicki Gatewood!!!
                                </div>
                            </div>
                        </section>
                        <section class="card review">
                            <div class="row">
                                <div class="rating-box col-md-2">
                                    Rating<br>
                                    <h3>5</h3>
                                    Difficulty<br>
                                    <h3>3.5</h3>
                                </div>
                                <div class="comment col-md-10">
                                    Most amazing, caring teacher. She goes out of her way to help her students pass, but you do have to put in the effort and time. I hate math and it hates me back, it is very challenging for me. Her encouragement and is the only thing that kept me going and I passed. Thank you , Thank you Vicki Gatewood!!!
                                </div>
                            </div>
                        </section>
                        <section class="card review">
                            <div class="row">
                                <div class="rating-box col-md-2">
                                    Rating<br>
                                    <h3>5</h3>
                                    Difficulty<br>
                                    <h3>3.5</h3>
                                </div>
                                <div class="comment col-md-10">
                                    Most amazing, caring teacher. She goes out of her way to help her students pass, but you do have to put in the effort and time. I hate math and it hates me back, it is very challenging for me. Her encouragement and is the only thing that kept me going and I passed. Thank you , Thank you Vicki Gatewood!!!
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection