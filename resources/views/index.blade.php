@extends ('layout')

@section ('content')
	<div class="container marg-top-8">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            <div class="carod">

                    <!--Card content-->
                    <div class="card-block">
                        <!--Title-->
                        <h4 class="card-title text-center">Find your school</h4>
                        <!--Text-->
                        <div class="marg-bottom-3">
                        <div class="row">
                               <div class="switch offset-md-1">
                                <label>
                                  <input type="checkbox" checked="checked">
                                  <span class="lever"></span>
                                  Name
                                </label>
                              </div>


                              <div class="switch offset-md-4">
                                <label>
                                  <input type="checkbox">
                                  <span class="lever"></span>
                                  Location
                                </label>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group offset-md-4">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select State</button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">State here</a>
                                        <a class="dropdown-item" href="#">Another state there</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="row">
                            <div class="col-md-12">
                                <div class="md-form input-group">
                                    <input type="text" class="form-control" placeholder="Enter name.">
                                    <span class="input-group-btn">
                                        <a class="btn btn-primary btn-sm"><i class="material-icons">search</i></a>
                                </span>
                                </div>
                            </div>
                        </div-->
                    </div>
                    <!--/.Card content-->
                </div>
            </div>
        </div>
    </div>
@endsection