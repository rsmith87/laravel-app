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
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#case-home" role="tab" aria-controls="home" aria-selected="true">Case Information</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="billing-info-tab" data-toggle="tab" href="#billing-info" role="tab" aria-controls="billing-info" aria-selected="false">Billing Information</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="case-invoices-tab" data-toggle="tab" href="#case-invoices" role="tab" aria-controls="case-invoices" aria-selected="false">Invoices</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="court-information-tab" data-toggle="tab" href="#court-information" role="tab" aria-controls="court-information" aria-selected="false">Court Information</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="opposing-councel-tab" data-toggle="tab" href="#opposing-councel" role="tab" aria-controls="opposing-councel" aria-selected="false">Opposing Councel</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" id="client-tab" data-toggle="tab" href="#client-information" role="tab" aria-controls="client" aria-selected="false">Client</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        @include('dashboard.case.case-information')

        @include('dashboard.case.billing-information')

        @include('dashboard.case.invoices')

        @include('dashboard.case.court-information')

        @include('dashboard.case.opposing-councel')
       
        @include('dashboard.case.client')

    </div>
</div>

@include('dashboard.modals.case-modals')

@endsection

