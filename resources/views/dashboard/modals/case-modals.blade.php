@section('extra_js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datetimepicker.min.js') }}"></script>
<script>
$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'L'

    });
});

</script>
@endsection

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
        <form method="POST" id="case-form" action="{{ route('legal_cases.post') }}">

        <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="case_name" />
                </div>

                <div class="form-group">
                    <label>Open date</label>
                    <div class="input-group date datetimepicker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target=".datetimepicker1" name="open_date"/>
                        <div class="input-group-append" data-target=".datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('case-form').submit()">Save changes</button>
        </div>
    </form>

        </div>
    </div>
</div>



<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="client-form" action="{{ route('legal_case.post_client') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="case_uuid" value="{{ $legal_case->case_uuid }}" />
                <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" name="first_name" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="last_name" />
                            </div>
                        </div>
                </div>
                <div class="row">                     
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address_1" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">State</label>
                            <select name="state" class="form-control">
                                @foreach(config('vars.states') as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>                                    
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" name="zip" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control" name="company" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Company title</label>
                            <input type="text" class="form-control" name="company_title" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control phone_us" placeholder="(___) ___-____" name="phone" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control email" name="email" />
                        </div>
                    </div>
                </div>


            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('client-form').submit()">Save changes</button>
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="billingInfo" tabindex="-1" role="dialog" aria-labelledby="billingInfo" aria-hidden="true">                <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Billing Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('legal_case.post_client_location') }}">
                <input type="hidden" name="client_uuid" value="{{ $legal_case->client->uuid ?? null }}" />
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-sm">
                        <label>Billable case?</label>
                        <div class="form-check billable">
                            <input type="checkbox" name="is_billable" class="form-check-input" />
                            <label class="form-check-label">Billable</label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="billing_type" class="form-control">
                                <option value="fixed">Fixed</option>
                                <option value="hourly">Hourly</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="billing_rate" class="form-control" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="opposingCouncel" tabindex="-1" role="dialog" aria-labelledby="opposingCouncel" aria-hidden="true">                <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Opposing Councel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('legal_case.post_opposing_councel') }}">
                <input type="hidden" name="case_uuid" value="{{ $legal_case->case_uuid ?? null }}" />
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control phone_us" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" name="fax" class="form-control phone_us" />
                        </div>
                    </div>  
                </div>
                <div class="row">                     
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address_1" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">State</label>
                            <select name="state" class="form-control">
                                @foreach(config('vars.states') as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>                                    
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" name="zip" class="form-control" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save address</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="caseInformation" tabindex="-1" role="dialog" aria-labelledby="caseInformation" aria-hidden="true">                
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Case Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <form method="POST" action="{{ route('legal_case.post_opposing_councel') }}">
                    <input type="hidden" name="case_uuid" value="{{ $legal_case->case_uuid ?? null }}" />
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Case name</strong></label>
                                <input type="text" class="form-control" name="name" value="{{ $legal_case->name ?? null }}" />
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <input type="text" name="status" class="form-control" value="{{ $legal_case->status ?? null }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Type</strong></label>
                                <input type="text" name="type" class="form-control" value="{{ $legal_case->type ?? null }}" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Number</strong></label>
                                <input type="text" name="number" class="form-control" value="{{ $legal_case->number ?? null }}" />
                            </div> 
                        </div>          
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Description</strong></label>
                                <input type="text" name="description" class="form-control" value="{{ $legal_case->description ?? null }}" />
                            </div>
                        </div>   

                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Claim Reference Number</strong></label>
                                <input type="text" name="claim_reference_number" class="form-control" value="{{ $legal_case->claim_reference_number ?? null }}" />
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Open date</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" value="{{ \Carbon\Carbon::parse($legal_case->close_date)->format('m/d/Y') ?? null }}" data-target="#datetimepicker1" name="open_date"/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        @if(!empty($legal_case->close_date))
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Close date</strong></label>
                                <input type="text" name="close_date" class="form-control" value="{{ \Carbon\Carbon::parse($legal_case->close_date)->format('m/d/Y') ?? null }}" />
                            </div>
                        </div> 
                        @endif
                    </div>
                    <div class="row">
                        @if(!empty($legal_case->statute_of_limitations))
                        <div class="col-sm">
                            <div class="form-group">
                                <label><strong>Statute of Limitations</strong></label>
                                <input type="text" name="close_date" class="form-control" value="{{ \Carbon\Carbon::parse($legal_case->statute_of_limitations)->format('m/d/Y') ?? null }}" />
                            </div>
                        </div> 
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>    
</div>
            


<div class="modal fade" id="addClientAddress" tabindex="-1" role="dialog" aria-labelledby="clientAddress" aria-hidden="true">                
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Client Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <form method="POST" action="{{ route('legal_case.post_client_location') }}">
                    <input type="hidden" name="client_uuid" value="{{ $legal_case->client->uuid ?? null }}" />
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address_1" value="{{ $legal_case->client->clientContactInfo->address_1 ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->city ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                                <div class="form-group">
                                    <label for="name">State</label>
                                    <select name="state" class="form-control">
                                        @foreach(config('vars.states') as $state)
                                            <option value="{{ $state }}" {{ !empty($legal_case->client->clientContactInfo->state) && $legal_case->client->clientContactInfo->state === $state ? "selected": "" }}>{{ $state }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" name="zip" value="{{ $legal_case->client->clientContactInfo->zip ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>    
</div>


<div class="modal fade" id="editOpposingCouncel" tabindex="-1" role="dialog" aria-labelledby="clientAddress" aria-hidden="true">                
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Opposing Councel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <form method="POST" action="{{ route('legal_case.post_client_location') }}">
                    <input type="hidden" name="client_uuid" value="{{ $legal_case->client->uuid ?? null }}" />
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="address_1" value="{{ $legal_case->legalCaseOpposingCouncel->opposing_councel_name ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->phone ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Fax</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->fax ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->address_1 ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->city ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="name">State</label>
                                <select name="state" class="form-control">
                                    @foreach(config('vars.states') as $state)
                                        <option value="{{ $state }}" {{ !empty($legal_case->client->clientContactInfo->state) && $legal_case->client->clientContactInfo->state === $state ? "selected": "" }}>{{ $state }}</option>
                                    @endforeach
                                </select>                                    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" name="zip" value="{{ $legal_case->client->clientContactInfo->zip ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div> 
</div>   


<div class="modal fade" id="editClient" tabindex="-1" role="dialog" aria-labelledby="editClient" aria-hidden="true">                
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <form method="POST" action="{{ route('legal_case.post_client') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="case_uuid" value="{{ $legal_case->case_uuid ?? null }}" />
                    <input type="hidden" name="client_uuid" value="{{ $legal_case->client->uuid ?? null }}" />

            <div class="modal-header">
                <h5 class="modal-title">Edit Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" name="first_name" value="{{ $legal_case->client->first_name ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" value="{{ $legal_case->client->last_name ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $legal_case->client->clientContactInfo->phone ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ $legal_case->client->clientContactInfo->email ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" name="company" value="{{ $legal_case->client->company ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="company_title" value="{{ $legal_case->client->company_title ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address_1" value="{{ $legal_case->client->clientContactInfo->address_1 ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->city ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                                <div class="form-group">
                                    <label for="name">State</label>
                                    <select name="state" class="form-control">
                                        @foreach(config('vars.states') as $state)
                                            <option value="{{ $state }}" {{ !empty($legal_case->client->clientContactInfo->state) && $legal_case->client->clientContactInfo->state === $state ? "selected": "" }}>{{ $state }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" name="zip" value="{{ $legal_case->client->clientContactInfo->zip ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

        </div>

    </div>    
</div>


<div class="modal fade" id="clientEvents" tabindex="-1" role="dialog" aria-labelledby="clientAddress" aria-hidden="true">                
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Events</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <form method="POST" action="{{ route('legal_case.post_client_location') }}">
                    <input type="hidden" name="client_uuid" value="{{ $legal_case->client->uuid ?? null }}" />
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Event name</label>
                                <input type="text" name="address_1" value="{{ $legal_case->client->clientContactInfo->address_1 ?? null }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ $legal_case->client->clientContactInfo->city ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                                <div class="form-group">
                                    <label for="name">State</label>
                                    <select name="state" class="form-control">
                                        @foreach(config('vars.states') as $state)
                                            <option value="{{ $state }}" {{ !empty($legal_case->client->clientContactInfo->state) && $legal_case->client->clientContactInfo->state === $state ? "selected": "" }}>{{ $state }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" name="zip" value="{{ $legal_case->client->clientContactInfo->zip ?? null }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>    
</div>