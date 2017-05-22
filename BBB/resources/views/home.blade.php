@extends('layout')

@section('content')
    <h2><strong>Your Flyers:</strong></h2>
    <hr>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Street</th>
          <th>State</th>
          <th>Price</th>
          <th>Address</th>
          <th>Images</th>
          <th>Control</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($flyers as $key => $flyer)
          <tr>
            <td>{{$key+1}}</td>
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
            <td class="control-item">
                <span class="label label-info vertical-center"><a href="flyers/{{$flyer->id}}/edit">Edit</a></span>
                | <span class="label label-danger align-middle"><a href="/flyers/delete/{{$flyer->id}}">Delete</a></span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
@stop


@section("scripts.footer")
@include("flash")

@stop