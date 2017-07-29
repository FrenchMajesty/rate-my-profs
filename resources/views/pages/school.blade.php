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
                                <h1 class="green-text">4.2</h1> <span>Location</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">4.5</h1> <span>Facilities</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">3.9</h1> <span>Opportunity</span>
                            </section>
                            <section class="row rating">
                                <h1 class="green-text">3.0</h1> <span>Socials</span>
                            </section>
                        </div>
                    </div>

                     <div class="more-details col-md-4">
                        <div class="card-block">
                            <h2>Harvard University</h2>
                            <p>Cambridge, MA.</p>
                            <a class="school-website" href="#">Website</a>
                            <button class="col-md-12 btn btn-primary primary">
                        Rate this school
                        </button>
                        <a class="school-website" href="#">Submit a correction</a>
                        </div>
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