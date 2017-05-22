@extends("layout")

@section ("content")
  <h1>Selling your Home??</h1>
  <hr>
  <div class="row">
    <form class="" action="/flyers" method="post" enctype="multipart/form-data">
      @include("flyers.form")
    </form>
  </div>
@stop
