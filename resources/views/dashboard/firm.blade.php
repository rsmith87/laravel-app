@extends('lgk_master') 
@section('content')
    @include('dashboard.error')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Firm Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="stripe-tab" data-toggle="tab" href="#stripe" role="tab" aria-controls="stripe" aria-selected="false">Stripe Integration</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @if(isset($firm))
            <button class="btn btn-warning mb-3 btn-sm" id="edit-case-information" data-toggle="modal" data-target="#editFirm">Edit firm</button>
                @endif
            <div class="col-lg mb-4 float-left">
                @if(isset($firm))
                <p>
                    <strong>Firm Information</strong>
                    <small>Information regarding your firm</small>
                </p>

                <label><strong>Firm Name</strong></label>
                <p>{{ $firm->name ?? null }}</p>
                
                <label><strong>Firm Address</strong></label>
                <address>
                    {{ $firm->firmLocation->address_1 ?? null }}<br />
                    {{ $firm->firmLocation->city ?? null }}, {{ $firm->firmLocation->state ?? null }} {{ $firm->firmLocation->zip ?? null }}
                </address>

                <label><strong>Firm Phone</strong></label>
                <p>{{ $firm->phone ?? null }}</p>

                <label><strong>Firm Fax</strong></label>
                <p>{{ $firm->fax ?? null }}</p>
                <p>
                    @else
                    <button class="btn btn-primary" id="edit-firm-information" data-toggle="modal" data-target="#editFirm">Add firm</button>

                    @endif
       

            </div>
            <!--/.col-md-6 mb-4-->


            <!--/.col-md-6 mb-4-->


        </div>


        <div class="tab-pane fade" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
            @if(empty($firm->firmBilling))
                <p>In order to receive client payments you must set up an account with Stripe.  Your fund paid by clients are deposited to this account.</p>
            @else
                <p>You've successfully authenticated with Stripe and are ready to receive payments!</p>
                <p>In case of error or problems receiving payment, click the button below to set up Stripe again.</p>
            @endif
            <a href="{{ route('firm.stripe_create') }}"><img src="{{ asset('img/blue-on-light.png') }}"/></a>
      
       </div>
       
    </div>
</div>

<script type="text/javascript">

</script>


@include('dashboard.modals.firm-modals')
@endsection