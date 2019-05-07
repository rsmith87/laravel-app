
<div class="modal fade" id="editFirm" tabindex="-1" role="dialog" aria-labelledby="editFirm" aria-hidden="true">  
        <form method="POST" action="{{ route('firm.post') }}">
              
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Firm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   


        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $firm->name ?? null }}" name="name">
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control phone_us" value="{{ $firm->phone ?? null }}" placeholder="(___) ___-____" name="phone" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control phone_us" value="{{ $firm->fax ?? null }}" placeholder="(___) ___-____" name="fax" />
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" value="{{ $firm->firmLocation->address_1 ?? null }}" name="address" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" value="{{ $firm->firmLocation->city ?? null }}" name="city" />
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>State</label>
                    <select name="state" class="form-control">
                        @foreach(config('vars.states') as $state)
                            <option value="{{ $state }}" {{ !empty($firm->firmLocation->state) && $firm->firmLocation->state === $state ? "selected": "" }}>{{ $state }}</option>
                        @endforeach
                    </select>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>Zip</label>
                    <input type="text" class="form-control" value="{{ $firm->firmLocation->zip ?? null }}" name="zip" />
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    </div>

</div> 
</form>

</div>