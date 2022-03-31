@extends('lgk_master') 

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
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#case-home" role="tab" aria-controls="home" aria-selected="true">Client Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#case-home" role="tab" aria-controls="home" aria-selected="true">Communication Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#case-home" role="tab" aria-controls="home" aria-selected="true">Invoices</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="case-home" role="tabpanel" aria-labelledby="case-home-tab">
    @if(isset($client))
        <button class="btn btn-primary mb-3 btn-sm" id="edit-client-information" data-toggle="modal" data-target="#edit-client-modal">Edit client</button> 
        <button class="btn btn-primary mb-3 btn-sm" id="text-client" data-toggle="modal" data-target="#text-client-modal">Text client</button> 
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
        <div class="row">
            <div class="col-sm">
                <label><strong>Address</strong></label>
                <p>
                    {{ $client->clientContactInfo->address_1 }}<br />
                    {{ $client->clientContactInfo->address_2 ? $client->clientContactInfo->address_2 . "<br />" : "" }}
                    {{ $client->clientContactInfo->city }}, {{ $client->clientContactInfo->state }} {{ $client->clientContactInfo->zip }}
                </p>
            </div>
            <div class="col-sm">
                <label><strong>Contact Information</strong></label>
                <p><strong>Phone:</strong> {{ $client->clientContactInfo->phone }}</p>
                <p><strong>Email:</strong> {{ $client->clientContactInfo->email }}</p>
            </div>
        </div>

    </div>
</div>


@endsection

