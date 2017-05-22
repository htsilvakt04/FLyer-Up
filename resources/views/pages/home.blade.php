@extends("layout")

@section("content")
<div class="row">
    <div class="jumbotron text-center">
        <h1>Project Flyer</h1>
        <p>
          Wanna sell your house?? Why don't give it a click!
        </p>
        @if ($signedIn)
          <a href="/flyers/create" class="btn btn-primary btn-lg">Create Flyer</a>
        @else
          <a href="/login" class="btn btn-primary btn-lg">Sign In</a>
        @endif
    </div>
    <div class="text-center" style="margin: 3rem 0">
      <h3><strong>Currently House For Sell</strong></h3>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Street</th>
          <th>State</th>
          <th>Price</th>
          <th>Address</th>
          <th>Images</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($flyers as $key => $flyer)
          <tr>
            <td class="<?php if(auth()->check() && auth()->user()->owns($flyer)) {echo "bg-info";} ?>">{{$key+1}}</td>
            <td>{{$flyer->street}}</td>
            <td>{{$flyer->state}}</td>
            <td>{{$flyer->price}}</td>
            <td><a href="{{flyer_path($flyer)}}">{{$flyer->zip}}/{{$flyer->street}}</a></td>
            <td>
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  @if($photos =  $flyer->displaySomePhotoInMainView(3))
                    @foreach($photos as $photo)
                      
                        <a href="/{{$photo['path']}}" data-toggle="lightbox" data-gallery="gallery-{{$key}}" style="display: inline-block; margin: 0 5px;">
                        <img src="/{{$photo['mini_thumbnail_path']}}" alt="" class="img-rounded">
                        </a>
                      
                    @endforeach
                  @endif
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      {{$flyers->links()}}
    </div>
</div>
@stop

@section("scripts.footer")
@include("flash")
<script>

$(function () {

  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });

});

</script>

@stop