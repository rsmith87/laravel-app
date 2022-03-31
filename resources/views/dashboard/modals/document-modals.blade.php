<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init(
        {
            selector:'textarea',
            apiKey: 'ozvyi477shrjovp1zdd76e9my93m5102vhy9s0gu99w19fup',
            height: 600
        }
    );


</script>

<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="addDocument" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">   
                <form action="/documents/file-upload"
                    id="documentDropzone"
                    enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="dz-message" data-dz-message><span>Drop files or click here to upload</span></div>
                </form>
            </div>
        </div>
    </div> 
</div>

<div class="modal fade" id="add-folder" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true">  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('documents.post_folder') }}">
                {!! csrf_field() !!}
                <div class="modal-body">   
                    <label>Folder name</label>
                    <input type="text" name="folder_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div> 
</div>

<div class="modal fade" id="create-document" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true">  
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('documents.create') }}">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <input type="text" class="form-control" name="document_name" placeholder="Name" />
                </div>
                <div class="modal-body">   
                    <textarea name="tinymce_data"></textarea>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
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
            </form>
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
            </form>
        </div>
    </div> 
</div>