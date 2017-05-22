@extends("layout")
@section("scripts.header")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@stop
@section("content")

  <div class="row">
    <div class="col-md-3">
      <h1>{{$flyer->street}}</h1>
      <h2>{{$flyer->price}}</h2>
      <hr>

      <div class="description">
        {{$flyer->description}}
      </div>
    </div>

    <div class="col-md-9">
      @foreach($flyer->photos->chunk(4) as $set)
        <div class="row" style="margin-bottom: 2rem">
          @foreach($set as $photo)
            <div class="col-md-3 gallery_item">
              @if(!empty(request()->user()) && $photo->flyer->ownedBy(request()->user()))
                <form action="/photos/{{$photo->id}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <button type="submit" class="close" name="delete" aria-label="Close" style="position: absolute; top: -1.5rem;"><span aria-hidden="true">&times;</span></button>
                </form>
              @endif
              <a href="/{{$photo->path}}" data-toggle="lightbox" data-gallery="gallery">
                
                <img src="/{{$photo->thumbnail_path}}" alt="" class="img-thumbnail">

              </a>
            </div>
          @endforeach
        </div>
      @endforeach
      @if ($user && $user->owns($flyer))
        <hr>
        <form id="addPhotosForm" class="dropzone" action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" method="POST">
          {{ csrf_field() }}
        </form>
      @endif
    </div>

  </div>
@stop
@section("scripts.footer")
@include("flash")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

  <script>
  
  Dropzone.options.addPhotosForm = {
    paramName: "photo", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    };

  $(function () {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
  });

  
  </script>
@stop
