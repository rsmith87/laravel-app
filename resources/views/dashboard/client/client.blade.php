@extends('lgk_master') 

@section('extra_css')
<link rel='stylesheet' href='{{ asset('css/datetimepicker.min.css') }}'>
@endsection

@section('extra_js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datetimepicker.min.js') }}"></script>
<script >
$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'L'

    });

    $('#cases-table tbody tr td').click(function(){
        var $this = $(this);
        var uuid = $this.parent().find('#client-uuid').text();
        window.location.href = '/clients/'+uuid;
    });
});

    </script>
@endsection

@section('content')
    @include('dashboard.error')
    
<div class="container-fluid">

    <nav class="nav nav-pills mb-3">
        <a class="nav-link active" href="#" data-toggle="modal" data-target="#addCaseModal">Add client</a>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Active Clients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inactive Clients</a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
           @if(count($clients) > 0)
            <table class="table table-striped table-hover" id="cases-table">
                <thead>
                    <tr>
                        <th scope="col">UUID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Open date</th>
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td id="client-uuid">{{ $client->uuid }}</td>
                            <td>{{ $client->first_name }}</td>
                            <td>{{ $client->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($client->created_at)->format('m/d/Y') }}</td>
                            <td>@mdo</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div id="no-cases"><p>No clients, yet!  Add a client above</p></div>
            @endif

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            
        </div>


       
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create case</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="case-form" action="{{ route('legal_cases.post') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="case_name" />
                </div>

                <div class="form-group">
                    <label>Open date</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="open_date"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <span class="input-group-text"><i class="fa fa-calendar"></i> </span>
                        </div>
                    </div>
         
                    
                </div>

                
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('case-form').submit()">Save changes</button>
        </div>
        </div>
    </div>
</div>

@endsection

