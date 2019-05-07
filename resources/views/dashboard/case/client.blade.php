<div class="tab-pane fade" id="client-information" role="tabpanel" aria-labelledby="client-tab">
    @if(count($legal_case->client) > 0)
    <button class="btn btn-warning btn-sm mb-3" id="edit-client" href="#" data-toggle="modal" data-target="#editClient">Edit Client</button>
    <button class="btn btn-primary btn-sm ml-1 mb-3" id="create-client-user" href="#">Create account for client</button>           
    <button class="btn btn-primary btn-sm ml-1 mb-3" id="send-client-text" href="#">Send text</button>           
    <button class="btn btn-primary btn-sm ml-1 mb-3" id="create-client-event" href="#">Create client event</button>    
    <button class="btn btn-primary btn-sm ml-1 mb-3" id="log-client-communication" href="#">Log communication</button>
    <button class="btn btn-danger btn-sm ml-1 mb-3" id="delete-client" href="#">Delete client</button>
    @endif

    @if(count($legal_case->client) > 0 && count($legal_case->client->clientContactInfo) < 1)
    <button class="btn btn-primary btn-sm mb-3" id="client-address-button" href="#">Add address</button>
    @endif

    @if(count($legal_case->client) > 0)
    <div class="address-form">
        <div class="row">
            <div class="col-sm">
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

    </div>
    @endif

    @if(count($legal_case->client) > 0)
    <div class="row">
        <div class="col-sm">
            <label><strong>First name</strong></label>
            <p>{{ $legal_case->client->first_name ?? null }}</p>
        </div>
        <div class="col-sm">
            <label><strong>Last name</strong></label>
            <p>{{ $legal_case->client->last_name ?? null }}</p>
        </div>
        <div class="col-sm">
            <label><strong>Phone</strong></label>
            <p>{{ $legal_case->client->clientContactInfo->phone ?? null }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <label><strong>Email</strong></label>
            <p>{{ $legal_case->client->clientContactInfo->email ?? null }}</p>
        </div>
        <div class="col-sm">
            <label><strong>Address</strong></label>
            <p>{{ $legal_case->client->clientContactInfo->address_1 ?? null }}<br />
               {{ $legal_case->client->clientContactInfo->city ?? null }}, {{ $legal_case->client->clientContactInfo->state ?? null }} {{ $legal_case->client->clientContactInfo->zip ?? null }}
            </p>
        </div>
        <div class="col-sm">

        </div>
    </div>
    @else
    <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#clientModal">Add Client</button>
    @endif
</div>

