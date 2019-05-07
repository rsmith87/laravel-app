@if ($errors->any())
    <div class="alert alert-danger ml-3 mr-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-primary ml-3 mr-3">
        <ul>
            <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif