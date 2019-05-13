<div class="tab-pane fade show active" id="case-home" role="tabpanel" aria-labelledby="case-home-tab">
    @if(isset($legal_case))
        <button class="btn btn-primary mb-3 btn-sm" id="edit-case-information" data-toggle="modal" data-target="#caseInformation">Edit case information</button>
    @else
        <button class="btn btn-primary mb-3 btn-sm" id="add-case-information" data-toggle="modal" data-target="#caseInformation">Add case information</button>
    @endif
    <div class="row">
        <div class="col-sm">
            <label><strong>Case name</strong></label>
            <p>{{ $legal_case->name ?? null }}</p>
        </div>

        <div class="col-sm">
            <label><strong>Status</strong></label>
            <p>{{ $legal_case->status ?? null }}</p>
        </div>

        <div class="col-sm">
            <label><strong>Type</strong></label>
            <p>{{ $legal_case->type ?? null }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <label><strong>Number</strong></label>
            <p>{{ $legal_case->number ?? null }}</p>
        </div> 
        
        <div class="col-sm">
            <label><strong>Description</strong></label>
            <p>{{ $legal_case->description ?? null }}</p>
        </div>   

        <div class="col-sm">
            <label><strong>Claim Reference Number</strong></label>
            <p>{{ $legal_case->claim_reference_number ?? null }}</p>
        </div>           
    </div>

    <div class="row">
        <div class="col-sm">
            <label><strong>Open date</strong></label>
            <p>{{ \Carbon\Carbon::parse($legal_case->open_date)->format('m/d/Y') ?? null }}</p>
        </div> 

        @if(!empty($legal_case->close_date))
        <div class="col-sm">
            <label><strong>Close date</strong></label>
            <p>{{ \Carbon\Carbon::parse($legal_case->close_date)->format('m/d/Y') ?? null }}</p>
        </div> 
        @endif

        @if(!empty($legal_case->statute_of_limitations))
        <div class="col-sm">
            <label><strong>Statute of Limitations</strong></label>
            <p>{{ $legal_case->statute_of_limitations ?? null }}</p>
        </div> 
        @endif
    </div>

</div>