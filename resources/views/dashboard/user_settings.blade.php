@extends('lgk_master') 
@section('content')
    @include('dashboard.error')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="user-info-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Information</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>User Information</strong>
                        <small>Your Legalkeeper Credentials</small>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('settings.post') }}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" value="{{ $user->name ?? null }}" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" class="form-control" id="name" value="{{ $user->email ?? null }}" placeholder="Enter your name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <h4>Password change</h4>
                                        
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-key"></i> Update password</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!--/.card-body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                    </div>
                </div>

                <div class="card">
                        <div class="card-header">
                            <strong>Legal Information</strong>
                            <small>Your whereabouts</small>
                        </div>
                        <form method="POST" action="{{ route('settings.legal_info') }}">
                            <div class="card-body">
    
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="name">State of Bar</label>
                                            <select name="state_of_bar" class="form-control">
                                                @foreach(config('vars.states') as $state)
                                                    <option value="{{ $state }}" {{ !empty($user->userLawInfo->state_of_bar) && $state === $user->userLawInfo->state_of_bar ? 'selected' : ''}}>{{ $state }}</option>
                                                @endforeach
                                            </select>                                    
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Bar Number</label>
                                            <input type="text" class="form-control" value="{{ $user->userLawInfo->bar_number ?? null }}" name="bar_number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <input type="text" class="form-control" value="{{ $user->userLawInfo->education ?? null }}" name="education" />
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <input type="text" class="form-control" value="{{ $user->userLawInfo->experience ?? null }}" name="experience" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label>Focus</label>
                                                <input type="text" class="form-control" value="{{ $user->userLawInfo->focus ?? null }}" name="focus" />
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" value="{{ $user->userLawInfo->title ?? null }}" name="title" />
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Practice areas</label>
                                            <textarea name="practice_areas" class="form-control">{{ $user->userLawInfo->practice_areas ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                            <!--/.card-body-->
    
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                <!--/.card-->


                <div class="card">
                        <div class="card-header">
                            <strong>Location</strong>
                            <small>Your whereabouts</small>
                        </div>
                        <form method="POST" action="{{ route('settings.location') }}">
                            <div class="card-body">
    
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" class="form-control" name="address_1" value="{{ $user_location->address_1 ?? null }}" placeholder="Street Address">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" value="{{ $user_location->city ?? null }}" name="city" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select name="state" class="form-control">
                                                @foreach(config('vars.states') as $state)
                                                    <option value="{{ $state }}" {{ !empty($user_location->state) && $state === $user_location->state ? 'selected' : ''}}>{{ $state }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Zip</label>
                                            <input type="text" class="form-control" value="{{ $user_location->zip ?? null }}" name="zip" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Timezone</label>
                                            <select name="timezone" class="form-control">
                                                @foreach($timezones as $timezone)
                                                    <option value="{{ $timezone }}" {{ !empty($user_location->timezone) && $user_location->timezone === $timezone ? 'selected' : ''}}>{{ $timezone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                            <!--/.card-body-->
    
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                    <!--/.card-->

            </div>
            <!--/.col-md-6 mb-4-->





        </div>




        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">


    </div>
</div>
@endsection