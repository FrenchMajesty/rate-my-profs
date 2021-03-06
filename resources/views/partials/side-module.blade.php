<div class="col-md-4">
            <div class="row">
                <div class="category col-md-3">
                    <a class="btn btn-primary btn-sm primary" data-type="profs"><i class="material-icons">person</i><br> {{__('profs-')}}</a>
                    <a class="btn btn-primary btn-sm primary" data-type="school"><i class="material-icons">school</i><br> {{__('school')}}</a>
                    <a class="btn btn-primary btn-sm primary" data-type="review"><i class="material-icons">star</i><br> {{__('review')}}</a>
                </div>
                <div id="side-module" class="col-md-9">
                    
                </div>
                <div style="display: none">
                    <div class="card scrollable" data-id="similar">
                            <div class="card-block">
                                <h4 class="card-title">{{__('find profs at')}}</h4>
                                <p><b>{{isset($school) ? $school->name : ''}} {{__('in :location', ['location' => isset($school) ? $school->location : ''])}}</b></p>
                                <div class="md-form col-md-12">
                                        <input type="text" name="department" data-provide="typeahead" class="form-control" placeholder="{{__('department name')}}" value="{{__('math')}}" autocomplete="off" autofocus>
                                        <label>{{__('in dept of')}}</label>
                                    </div>
                                <hr>
                                @if(isset($suggestions) && count($suggestions) > 0)
                                <section class="sort row">
                                    <span style="line-height: 41px">{{__(':count profs found', ['count' => count($suggestions)])}}</span>
                                    <div class="btn-group col-md-6">
                                            <button class="btn btn-primary primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('sort by')}}</button>

                                            <div class="dropdown-menu dropdown-primary">
                                                <a class="dropdown-item" href="#">{{__('most rated')}}</a>
                                                <a class="dropdown-item" href="#">{{__('highest rated')}}</a>
                                                <a class="dropdown-item" href="#">{{__('least difficult')}}</a>
                                            </div>
                                        </div>
                                </section><br>
                                <div class="row">
                                    <div class="md-form col-md-11">
                                        <input type="text" name="prof" data-provide="typeahead" class="input-alternate" placeholder="{{__('prof name')}}">
                                    </div>
                                </div>
                                <ul class="teacher-list">
                                    @foreach($suggestions as $prof)
                                    <a href="{{route('prof.view',[$prof->id])}}" class="list-group-item list-group-item-action flex-column align-items-start teacher-list-result">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h4 class="mb-1">{{$prof->name}} {{$prof->lastname}}</h4>
                                            <span class="badge badge-primary badge-pill primary">{{number_format($prof->rating,1)}}</span>
                                          <!--small class="text-muted">3 days ago</small-->
                                        </div>
                                        <small class="text-muted">{{__(':count reviews', ['count' => $prof->ratings_count])}}</small>
                                    </a>
                                    @endforeach
                                    <br>
                                    <button class="col-md-12 btn btn-primary primary">{{__('load more')}}
                                    </button>
                                </ul>
                                @else
                                    <h6 class="text-center">{{__('no similar prof')}}.</h6>
                                @endif

                            </div>
                    </div>
                    <div class="card" data-id="school">
                            <div class="card-block">
                            <h4 class="card-title marg-bottom-1">{{__('find school')}}</h4>
                            {{__('search by')}}
                                <div class="row marg-bottom-1">
                                    <fieldset class="form-group">
                                        <input name="filter" value="name" type="radio" id="radio2" checked="checked">
                                        <label for="radio2">{{__('name')}}</label>
                                    </fieldset>
                                    <fieldset class="form-group offset-md-1">
                                        <input name="filter" value="location" type="radio" id="radio1">
                                        <label for="radio1">{{__('location')}}</label>
                                    </fieldset>
                                </div>
                                <hr>
                                <form action="{{route('pages.search')}}" class="school-search" data-form="name" data-active="1">
                                    <div class="row">
                                        <div class="md-form col-md-12">
                                            <input type="text" name="school" data-provide="typeahead" class="form-control" placeholder="{{__('school name')}}" autocomplete="off">
                                            <input type="hidden" name="sID">
                                        </div>
                                    </div>
                                    <div class="row offset-md-3">
                                        <button class="btn btn-primary primary">{{__('search')}}</button>
                                    </div>
                                </form>
                                <form data-form="location" data-active="0" style="display: none">
                                    <div class="row">
                                        <div class="btn-group col-md-12">
                                            <button class="btn btn-primary primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">{{__('select state')}}</button>

                                            <div class="dropdown-menu" style="width: 100%">
                                                <a class="dropdown-item" href="#">{{__('no school yet')}}</a>
                                            </div>
                                        </div>
                                    </div><br>
                                </form>
                            </div>
                    </div>
                    <div class="card" data-id="profs">
                        <div class="card-block">
                        <h4 class="card-title marg-bottom-1">{{__('find prof')}}</h4>
                        {{__('search by')}}
                            <div class="row marg-bottom-1">
                                <fieldset class="form-group">
                                    <input name="filter2" value="name" type="radio" id="radio2" checked="checked">
                                    <label for="radio2">{{__('name')}}</label>
                                </fieldset>
                                <fieldset class="form-group offset-md-1">
                                    <input name="filter2" value="school" type="radio" id="radio1">
                                    <label for="radio1">{{__('school')}}</label>
                                </fieldset>
                            </div>
                            <hr><br>
                            <form action="{{route('pages.search')}}" data-form="name" data-active="1">
                                <div class="row">
                                    <div class="md-form col-md-12">
                                        <input type="text" name="school" data-provide="typeahead" class="form-control" autocomplete="off">
                                        <input type="hidden" name="sID">
                                        <label>{{__('looking for prof at')}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="md-form col-md-12">
                                        <input type="text" name="prof" data-provide="typeahead" class="form-control" autocomplete="off">
                                        <input type="hidden" name="pID">
                                        <label>{{__('named')}}</label>
                                    </div>
                                </div>
                                <div class="row offset-md-3">
                                    <button class="btn btn-primary primary">{{__('search')}}</button>
                                </div>
                            </form>
                            <form action="{{route('pages.search')}}" data-form="school" data-active="0" style="display: none">
                                <div class="row">
                                    <div class="md-form col-md-12">
                                        <input type="text" name="school" data-provide="typeahead" class="form-control" autocomplete="off">
                                        <input type="hidden" name="sID">
                                        <label>{{__('looking for profs at')}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="mx-auto">{{__('in the')}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <div class="md-form col-md-12">
                                        <select name="dept" class="browser-default form-control">
                                        <option selected disabled>{{__('department name')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row offset-md-3">
                                    <button class="btn btn-primary primary">{{__('search')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" data-id="review">
                            <div class="card-block">
                            <h4 class="card-title marg-bottom-1">{{__('rate a')}}</h4>
                                <div class="row marg-bottom-1">
                                    <fieldset class="form-group">
                                        <input name="filter" value="prof" type="radio" id="radio2" checked="checked">
                                        <label for="radio2">{{__('prof')}}</label>
                                    </fieldset>
                                    <fieldset class="form-group offset-md-1">
                                        <input name="filter" value="school" type="radio" id="radio1">
                                        <label for="radio1">{{__('school')}}</label>
                                    </fieldset>
                                </div>
                                <form action="{{route('pages.search')}}" data-form="prof" data-active="1">
                                    <div class="row">
                                        <div class="md-form col-md-12">
                                            <input type="text" name="prof" data-provide="typeahead" class="form-control" placeholder="{{__('prof name')}}" autocomplete="off">
                                            <input type="hidden" name="pID">
                                            <label>{{__('i want to rate')}}</label>
                                        </div>
                                    </div>
                                    <div class="row offset-md-3">
                                        <button class="btn btn-primary primary">{{__('search')}}</button>
                                    </div>
                                </form>

                                <form action="{{route('pages.search')}}" data-form="school" data-active="0" style="display: none">
                                    <div class="row">
                                        <div class="md-form col-md-12">
                                            <input type="text" name="school" data-provide="typeahead" class="form-control" placeholder="{{__('school name')}}" autocomplete="off">
                                            <input type="hidden" name="sID">
                                            <label>{{__('i want to rate')}}</label>
                                        </div>
                                    </div>
                                    <div class="row offset-md-3">
                                        <button class="btn btn-primary primary">{{__('search')}}</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>