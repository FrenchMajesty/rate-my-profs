<div class="col-md-4">
            <div class="row">
                <div class="category col-md-3">
                    <a class="btn btn-primary btn-sm primary" data-type="profs"><i class="material-icons">person</i><br> {{__('profs-')}}</a>
                    <a class="btn btn-primary btn-sm primary" data-type="school"><i class="material-icons">school</i><br> {{__('school')}}</a>
                    <a class="btn btn-primary btn-sm primary" data-type="review"><i class="material-icons">star</i><br> {{__('review')}}</a>
                </div>
                <div id="side-module" class="col-md-9">
                    <div id="similar-profs" class="card animated slideInLeft">
                        <div class="card-block">
                            <h4 class="card-title">{{__('find profs at')}}</h4>
                            <p><b>Harvard University {{__('at :location', ['location' => 'Cambridge'])}}</b>
                                <a href="#"><i class="material-icons">edit</i></a>
                            </p>
                            <div class="md-form col-md-12">
                                    <input type="text" class="form-control" placeholder="{{__('department name')}}" value="{{__('math')}}">
                                    <label>in</label>
                                </div>
                            <hr>

                            <section class="sort row">
                                <span style="line-height: 64px">{{__(':count profs found', ['count' => 37])}}</span>
                                <select class="col-md-6 mdb-select">
                                    <option value="" disabled>{{__('sort by')}}</option>
                                    <option value="1" selected>{{__('most rated')}}</option>
                                    <option value="2">{{__('highest rated')}}</option>
                                    <option value="3">{{__('least difficult')}}</option>
                                </select>
                            </section><br>
                                <div class="row">
                                <div class="md-form col-md-11">
                                    <input type="text" class="input-alternate" placeholder="{{__('prof name')}}">
                                </div>
                            </div>
                            <ul class="teacher-list">
                            <?php $i = 0; while($i < 20) { ?>
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start teacher-list-result">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Barrack Obama</h5>
                                        <span class="badge badge-primary badge-pill primary">4.8</span>
                                      <!--small class="text-muted">3 days ago</small-->
                                    </div>
                                    <small class="text-muted">{{__(':count reviews', ['count' => 23])}}</small>
                                </a>
                                <?php $i++; } ?>
                                <br>
                                <button class="col-md-12 btn btn-primary primary">{{__('load more')}}</button>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card" data-id="school" style="display: none">
                        <div class="card-block">
                        <h4 class="card-title marg-bottom-1">{{__('find school')}}</h4>
                        {{__('search by')}}
                            <div class="row marg-bottom-1">
                                <fieldset class="form-group">
                                    <input name="filter" type="radio" id="radio2">
                                    <label for="radio2">{{__('name')}}</label>
                                </fieldset>
                                <fieldset class="form-group offset-md-1">
                                    <input name="filter" type="radio" id="radio1">
                                    <label for="radio1">{{__('location')}}</label>
                                </fieldset>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="md-form col-md-12">
                                    <input type="text" class="form-control" placeholder="{{__('school name')}}">
                                </div>
                            </div>
                            <div class="row offset-md-3">
                                <button class="btn btn-primary primary">{{__('search')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-id="profs" style="display: none">
                        <div class="card-block">
                        <h4 class="card-title marg-bottom-1">{{__('find prof')}}</h4>
                        {{__('search by')}}
                            <div class="row marg-bottom-1">
                                <fieldset class="form-group">
                                    <input name="filter" type="radio" id="radio2">
                                    <label for="radio2">{{__('name')}}</label>
                                </fieldset>
                                <fieldset class="form-group offset-md-1">
                                    <input name="filter" type="radio" id="radio1">
                                    <label for="radio1">{{__('school')}}</label>
                                </fieldset>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="md-form col-md-12">
                                    <input type="text" class="form-control" placeholder="{{__('enter school')}}">
                                    <label>{{__('looking for prof at')}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="md-form col-md-12">
                                    <input type="text" class="form-control" placeholder="{{__('prof name')}}">
                                    <label>{{__('named')}}</label>
                                </div>
                            </div>
                            <div class="row offset-md-3">
                                <button class="btn btn-primary primary">{{__('search')}}</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>