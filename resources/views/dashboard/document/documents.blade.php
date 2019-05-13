@extends('master') 

@section('extra_css')
@endsection

@section('extra_js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>

<script>
$(function () {
    $('.folder').click(function(){
        var $this = $(this);
        if($this.next().hasClass('closed')){
            $this.next().removeClass('closed').addClass('open');
        } else {
            $this.next().removeClass('open').addClass('closed');
        }

        if($this.find('.document-document .col-sm:nth-child(1) span i').hasClass('fa-folder-open')){
            $this.find('.document-document .col-sm:nth-child(1) span i').removeClass('fa-folder-open').addClass('fa-folder');
        } else {
            $this.find('.document-document .col-sm:nth-child(1) span i').removeClass('fa-folder').addClass('fa-folder-open');   
        }
    });
});
</script>
@endsection

@section('content')
    @include('dashboard.error')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-2">
            <a href="#" class="btn btn-primary btn-block" id="add-document" data-toggle="modal" data-target="#addDocument"><i class="fas fa-file"></i> Add Document</a>
            <!--<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addFolder"><i class="fas fa-folder-plus"></i> Add Folder</a>-->
            <hr>
            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-file-alt"></i> Create Document</a>

        </div>
        <div class="col-12 col-sm-10" id="document-main">
            <div class="documents col-12">
                <div class="documents-menu">

                </div>
                @foreach($documents as $document)
                <div class="documents-content">
                    <div class="document-document row">
                        <div class="col-sm">
                            <span>
                                @if($document->type === 'jpeg' || $document->type === 'png' || $document->type === 'gif')
                                    <i class="fas fa-2x fa-file-image"></i> 
                                @elseif($document->type === 'pdf')
                                    <i class="fas fa-2x fa-file-pdf"></i>
                                @elseif($document->type === 'docx')
                                    <i class="fas fa-2x fa-file-word"></i> 
                                @elseif($document->type === 'xls')
                                    <i class="fas fa-2x fa-file-excel"></i>
                                @endif
                                {{ $document['name'] }}
                            </span>
                        </div>
                        <div class="col-sm">
                            <small><strong>Description: </strong>File 1 with random information</small>
                        </div>
                        <div class="col-sm">
                            <div class="document-buttons float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#docViewer" data-id="{{ $document->uuid }}"><i class="far fa-eye"></i></button>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#docEdit" data-id="{{ $document->uuid }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#docDelete" data-id="{{ $document->uuid }}"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
                        
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.modals.document-modals')
@endsection

