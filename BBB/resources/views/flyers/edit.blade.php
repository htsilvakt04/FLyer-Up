@section('scripts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@stop
@extends("layout")

@section ("content")
  <h1 class="text-center">Update Flyer:</h1>
  <hr>
  <div class="row">
  	<h3 class="col-md-12 basic-info">Basic Infor:</h3>
    <form class="" action="/flyers/{{$flyer->id}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PATCH">
      @include("flyers.form")
    </form>
  </div>
  <hr>
  <div class="row">
  	<h3 class="col-md-12 basic-info">Photos:</h3>
    @foreach($flyer->photos->chunk(4) as $set)
      <div class="row" style="margin-bottom: 2rem">
      	@foreach($set as $photo)
    	    <div class="col-md-3 gallery_item">
            <form action="/photos/{{$photo->id}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              {{csrf_field()}}
              <button type="submit" class="close" name="delete" aria-label="Close" style="position: absolute; top: -1.5rem;"><span aria-hidden="true">&times;</span></button>
            </form>
    	      <a href="/{{$photo->path}}" data-toggle="lightbox" data-gallery="gallery">
              @if(auth()->check() && auth()->user()->owns($flyer))
              
              <img src="/{{$photo->thumbnail_path}}" alt="" class="img-thumbnail">
            @endif
    	      </a>
    	    </div>
      	@endforeach
      </div>
    @endforeach
  </div>
  <div class="row">
    @if ($user && $user->owns($flyer))
      <hr>
      <form id="addPhotosForm" class="dropzone" action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" method="POST">
        {{ csrf_field() }}
      </form>
    @endif
  </div>
@stop
@section("scripts.footer")
@include("flash")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

  <script>
  
  Dropzone.options.addPhotosForm = {
    paramName: "photo", // The name that will be used to transfer the file
    maxFilesize:10,// MB
    };

  $(function () {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
  });
  2
  
  </script>
@stop