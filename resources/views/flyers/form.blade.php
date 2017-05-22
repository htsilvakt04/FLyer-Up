@inject("countries", "App\Http\Utilities\Country")
{{csrf_field()}}
<div class="col-md-6">
  @if (count($errors) > 0)
    <div class='alert alert-danger'>
      <ul>
        @foreach ($errors->all()  as $error)
          <li> {{ $error }} </li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="form-group">
    <label for="street">Street:</label>
    <input type="text" name="street" id="street" class="form-control" value="@if(isset($flyer)) {{$flyer->street}} @else {{old('street')}} @endif" required>
  </div>

  <div class="form-group">
    <label for="city">City:</label>
    <input 
    type="text" 
    name="city" 
    id="city" 
    class="form-control" 
    value="@if(isset($flyer)) {{$flyer->city}} @else {{old('city')}} @endif" 
    required>
  </div>

  <div class="form-group">
    <label for="zip">Zip/Postal Code:</label>
    <input type="text" name="zip" id="zip" class="form-control" value="@if(isset($flyer)) {{$flyer->zip}} @else {{old('zip')}} @endif" required>
  </div>

  <div class="form-group">
    <label for="country">Country:</label>
    <select id="country" name="country" class="form-control">
      @foreach ($countries::all() as $country => $code)
        <option value="{{$code}}" <?php if(isset($flyer) && $flyer->country == $country) {echo "selected";} ?>>{{$country}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="state">State:</label>
    <input type="text" name="state" id="state" class="form-control" value="@if(isset($flyer)) {{$flyer->state}} @else {{old('state')}} @endif" required>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label for="price">Price:</label>
    <input type="text" name="price" id="price" class="form-control" value="@if(isset($flyer)) {{$flyer->price}} @else {{old('price')}} @endif" required>
  </div>

  <div class="form-group">
    <label for="description">Home Description:</label>
    <textarea type="text" name="description" id="description" class="form-control" rows="10" required>@if(isset($flyer)) {{$flyer->description}} @else {{old('description')}} @endif
    </textarea>
  </div>
</div>

<div class="form-group col-md-12">
  <button type="submit" name="submit" class="btn btn-warning">
  @if(isset($flyer))
    {{"Update"}}
  @else 
    {{"Create"}}
  @endif
  </button>
</div>
