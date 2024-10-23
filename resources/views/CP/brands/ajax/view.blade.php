<div class="bulk border-bottom border-top border-dark p-0 m-3">
  <div class="row m-0">
    <div class="col col-3 text-end"> Name: </div>
    <div class="col col-9 border-start">{{ $brand->name }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Description: </div>
    <div class="col col-9 border-start">{{ $brand->description }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Company Name: </div>
    <div class="col col-9 border-start">{{ $brand->company->name}}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Brand Logo: </div>
    <div class="col col-9 border-start"> <img src="{{ asset('assets/img/logoBrand/'.$brand->brand_logo) }}" alt=""></div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> website: </div>
    <div class="col col-9 border-start">{{ $brand->website }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Created By: </div>
    <div class="col col-9 border-start"> {{@$brand->creator->name }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Date Created At: </div>
    <div class="col col-9 border-start">{{ $brand->created_at }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Edited By: </div>
    <div class="col col-9 border-start">{{@$brand->editor->name}} </div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Date Modified: </div>
    <div class="col col-9 border-start">{{ $brand->updated_at }}</div>
  </div>
</div>