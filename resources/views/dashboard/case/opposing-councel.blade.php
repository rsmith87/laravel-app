<div class="tab-pane fade" id="opposing-councel" role="tabpanel" aria-labelledby="opposing-councel-tab">
    @if(count($legal_case->legalCaseOpposingCouncel) < 1)
    <button class="btn btn-primary" id="add-opposing-councel" data-toggle="modal" data-target="#opposingCouncel">Add Opposing Councel</button>
    @else
    <button class="btn btn-warning btn-sm mb-3" data-toggle="modal" data-target="#editOpposingCouncel" id="edit-opposing-councel">Edit Opposing Councel</button>
    <a class="btn btn-primary btn-sm mb-3" id="phone-opposing-councel" href="tel:+1 {{ $legal_case->legalCaseOpposingCouncel->opposing_councel_phone }}">Phone</a>
    <button class="btn btn-primary btn-sm mb-3" id="email-opposing-councel" href="mailto:{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_email }}">Email</button>
    @endif
    

    @if(count($legal_case->legalCaseOpposingCouncel) > 0)
    <div class="row">
            <div class="col-sm">
                <label><strong>Name</strong></label>
                <p>{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_name ?? null }}</p>
            </div>
            <div class="col-sm">
                <label><strong>Phone</strong></label>
                <p>{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_phone ?? null }}</p>
            </div>
            <div class="col-sm">
                <label><strong>Fax</strong></label>
                <p>{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_fax ?? null }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <label><strong>Address</strong></label>
                <p>{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_address ?? null }}<br />
                    {{ $legal_case->legalCaseOpposingCouncel->opposing_councel_city ?? null }}, {{ $legal_case->legalCaseOpposingCouncel->opposing_councel_state ?? null }} {{ $legal_case->legalCaseOpposingCouncel->opposing_councel_zip ?? null }}</p>
            </div>
            <div class="col-sm">

            </div>
        </div>
    @endif
</div>