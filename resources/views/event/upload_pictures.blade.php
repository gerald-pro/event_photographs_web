@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-3 px-1">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Subir fotos a la galeria del evento</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                        <form action="{{ route('event.gallery.store', $event) }}" method="post" enctype="multipart/form-data"
                            id="image-upload" class="dropzone form-control mb-3" style="height: 400px">
                            @csrf
                        </form>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <input id="price" name="price" type="number" class="form-control" required
                                    placeholder="Precio (Bs)" value="0.01">
                                <div class="input-group-append">
                                    <button id="buttonSubmitE" type="button" class="btn btn-outline-primary"><i
                                            class="fa fa-fw fa-upload" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted">

            </div>
        </div>

    </div>

@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop

@section('js')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            maxFilesize: 5,
            maxFiles: 20,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            autoProcessQueue: false,
            addRemoveLinks: true,
            sending: function(file, xhr, formData) {
                var inputValue = document.getElementById('price').value;
                formData.append('price', inputValue);
            }
        });

        document.getElementById("buttonSubmitE").addEventListener("click", function() {
            dropzone.processQueue();
        });

        dropzone.on("complete", function(file) {
            if (dropzone.getQueuedFiles().length > 0) {
                dropzone.processQueue();
                console.log('Subiendo...');
            } else {
                setTimeout(() => {
                    dropzone.removeAllFiles()
                }, 1000);
            }
        });
    </script>
@stop
