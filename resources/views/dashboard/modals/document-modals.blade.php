<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>

<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="addDocument" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">   
                <form action="/documents/file-upload"
                    class="dropzone"
                    id="documentDropzone"
                    enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="dz-message" data-dz-message><span>Drop files or click here to upload</span></div>
                </form>
            </div>
        </div>
    </div> 
</div>

<div class="modal fade" id="docViewer" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('documents.post_folder') }}">
                {!! csrf_field() !!}
                <div class="modal-body">   
                    <label>Folder name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                </div>
        </div>
    </div> 
</div>

<div class="modal fade" id="docEdit" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('documents.post_folder') }}">
                {!! csrf_field() !!}
                <div class="modal-body">   
                    <label>Folder name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                </div>
        </div>
    </div> 
</div>

<div class="modal fade" id="docDelete" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('documents.post_folder') }}">
                {!! csrf_field() !!}
                <div class="modal-body">   
                    <label>Folder name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                </div>
        </div>
    </div> 
</div>

docEdit
docDelete