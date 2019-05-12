<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript">
Dropzone.options.documentDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
}
</script>


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