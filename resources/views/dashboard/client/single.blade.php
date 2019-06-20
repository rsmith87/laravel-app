@extends('master') 

@section('extra_css')
<link rel='stylesheet' href='{{ asset('css/datetimepicker.min.css') }}'>
@endsection

@section('extra_js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datetimepicker.min.js') }}"></script>
<script>
$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'L'

    });

    $('#cases-table tbody tr td').click(function(){
        var $this = $(this);
        var uuid = $this.parent().find('#case-uuid').text();
        window.location.href = '/cases/'+uuid;
    });
});

</script>
@endsection

@section('content')
    @include('dashboard.error')
    
<div class="container-fluid">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#case-home" role="tab" aria-controls="home" aria-selected="true">Case Information</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="case-home" role="tabpanel" aria-labelledby="case-home-tab">
                    @if(isset($client))
        <button class="btn btn-primary mb-3 btn-sm" id="edit-case-information" data-toggle="modal" data-target="#caseInformation">Edit case information</button>
    @else
        <button class="btn btn-primary mb-3 btn-sm" id="add-case-information" data-toggle="modal" data-target="#caseInformation">Add case information</button>
    @endif
        <div class="row">
            <div class="col-sm">
                <label><strong>First name</strong></label>
                <p>{{ $client->first_name ?? null }}</p>
            </div>
    
            <div class="col-sm">
                <label><strong>Last name</strong></label>
                <p>{{ $client->last_name ?? null }}</p>
            </div>
    
       </div>

    </div>
</div>


@endsection

