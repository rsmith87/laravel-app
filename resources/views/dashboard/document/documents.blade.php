@extends('lgk_master') 

@section('extra_css')
@endsection

@section('extra_js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pdf.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/viewer.js') }}"></script>
<script>
$(function () {
    var pageNum = 1;
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

    $('.doc-viewer').on('click', function(data) {
        var $this = $(this);
        var $id = $this.attr('data-id');
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '{!! URL::to('/'); !!}' + '/documents/document-viewer/'+$id,
            success: function(data){
                if(data.type == 'pdf') {
                    var html = view_html(data);
                    initPDFViewer(data.path);
                } else {
                    var html = view_html(data);
                }
                $('#docViewerModal').html(html);
                $('#docViewerModal').modal({show:true, focus:true});

            }, 
            error: function(){
                console.log('AJAX load did not work');
            }
        })
    });

    let currentPageIndex = 0;
    let pageMode = 1;
    let cursorIndex = Math.floor(currentPageIndex / pageMode);
    let pdfInstance = null;
    let totalPagesCount = 0;

    const viewport = document.querySelector("#viewport");
    window.initPDFViewer = function(pdfURL) {
        pdfjsLib.getDocument(pdfURL).then(pdf => {
        pdfInstance = pdf;
        totalPagesCount = pdf.numPages;
        initPager();
        initPageMode();
        render();
        });
    };

    function onPagerButtonsClick(event) {
        const action = event.target.getAttribute("data-pager");
        if (action === "prev") {
        if (currentPageIndex === 0) {
            return;
        }
        currentPageIndex -= pageMode;
        if (currentPageIndex < 0) {
            currentPageIndex = 0;
        }
        render();
        }
        if (action === "next") {
        if (currentPageIndex === totalPagesCount - 1) {
            return;
        }
        currentPageIndex += pageMode;
        if (currentPageIndex > totalPagesCount - 1) {
            currentPageIndex = totalPagesCount - 1;
        }
        render();
        }
    }
    function initPager() {
        const pager = document.querySelector("#pager");
        pager.addEventListener("click", onPagerButtonsClick);
        return () => {
        pager.removeEventListener("click", onPagerButtonsClick);
        };
    }

    function onPageModeChange(event) {
        pageMode = Number(event.target.value);
        render();
    }
    function initPageMode() {
        const input = document.querySelector("#page-mode input");
        input.setAttribute("max", totalPagesCount);
        input.addEventListener("change", onPageModeChange);
        return () => {
        input.removeEventListener("change", onPageModeChange);
        };
    }

    function render() {
        cursorIndex = Math.floor(currentPageIndex / pageMode);
        const startPageIndex = cursorIndex * pageMode;
        const endPageIndex =
        startPageIndex + pageMode < totalPagesCount
            ? startPageIndex + pageMode - 1
            : totalPagesCount - 1;

        const renderPagesPromises = [];
        for (let i = startPageIndex; i <= endPageIndex; i++) {
        renderPagesPromises.push(pdfInstance.getPage(i + 1));
        }

        Promise.all(renderPagesPromises).then(pages => {
            const pagesHTML = `<div style="width: ${
                pageMode > 1 ? "50%" : "100%"
            }"><canvas></canvas></div>`.repeat(pages.length);
            $('#docViewerModal .modal-body').innerHTML = pagesHTML;
            pages.forEach(renderPage);
        });
    }

    function renderPage(page) {
        let pdfViewport = page.getViewport(1);

        const container =
        viewport.children[page.pageIndex - cursorIndex * pageMode];
        pdfViewport = page.getViewport(container.offsetWidth / pdfViewport.width);
        const canvas = container.children[0];
        const context = canvas.getContext("2d");
        canvas.height = pdfViewport.height;
        canvas.width = pdfViewport.width;

        page.render({
            canvasContext: context,
            viewport: pdfViewport
        });
    }



    function view_html(data) {
        if(data.type == 'pdf')
        var html = '<div class="modal-dialog" role="document">' +
                        '<div class="modal-content">' +
                            '<div class="modal-body">';
                                if(data.type == 'jpeg' || data.type == 'png' || data.type == 'gif'){
                                    html  += '<img src="'+'{{ asset("/") }}'+data.path+'" />'
                                } else if (data.type == 'pdf') {
                                    html += '<div role="toolbar" id="toolbar">';
                                    html += '<div id="pager">'
                                    html += '<button data-pager="prev">prev</button>';
                                    html += '<button data-pager="next">next</button>';
                                    html += '</div>';
                                    html += '<div id="page-mode">';
                                    html += '<label>Page Mode <input type="number" value="1" min="1"/></label>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '<div role="main" id="viewport"></div>';
                                    html += '</div>';
                                }
            html +=         '</div>' +
                        '<div class="modal-footer">' +
                            '<input type="submit" class="btn btn-primary">' +
                        '</div>' + 
                    '</div>' + 
                '</div>';
        return html;
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    /**
     * Displays previous page.
     */
     function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }

    /**
     * Displays next page.
     */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }
    if(document.getElementById('previous') && document.getElementById('next')){
        document.getElementById('previous').addEventListener('click', onPrevPage);
        document.getElementById('next').addEventListener('click', onNextPage);
    }


});
</script>
@endsection

@section('content')
    @include('dashboard.error')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-2">
            <a href="#" class="btn btn-primary btn-block" id="add-document" data-toggle="modal" data-target="#addDocument"><i class="fas fa-file"></i> Add Document</a>
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-folder"><i class="fas fa-folder-plus"></i> Add Folder</a>
            <hr>
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#create-document"><i class="fas fa-file-alt"></i> Create Document</a>

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
                                @elseif($document->type === 'docx' || $document->type === 'bin')
                                    <i class="fas fa-2x fa-file-word"></i> 
                                @elseif($document->type === 'xls')
                                    <i class="fas fa-2x fa-file-excel"></i>
                                @elseif($document->type === 'folder')
                                    <i class="fas fa-2x fa-folder"></i>
                                @elseif($document->type === 'tinymce' || $document->type === 'txt')
                                    <i class="fas fa-2x fa-file-alt"></i>
                                @endif
                                {{ $document['name'] }}
                            </span>
                        </div>
                        <div class="col-sm">
                            <small><strong>Description: </strong>File 1 with random information</small>
                        </div>
                        <div class="col-sm">
                            <div class="document-buttons float-right">
                                <button class="btn btn-primary doc-viewer" data-toggle="modal" data-target=".docViewer" data-id="{{ $document->uuid }}"><i class="far fa-eye"></i></button>
                                <button class="btn btn-warning" data-toggle="modal" data-target=".docEdit" data-id="{{ $document->uuid }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" data-toggle="modal" data-target=".docDelete" data-id="{{ $document->uuid }}"><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="docViewerModal" tabindex="-1" role="dialog" aria-labelledby="docViewer" aria-hidden="true"></div>

@endsection

