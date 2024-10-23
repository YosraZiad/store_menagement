<div class="bulk border-bottom border-top border-dark p-0 m-3">
  <div class="row m-0">
    <div class="col col-3 text-end"> Name: </div>
    <div class="col col-9 border-start">{{ $product->name }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Description: </div>
    <div class="col col-9 border-start">{{ $product->description }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end">  ProductCategory: </div>
    <div class="col col-9 border-start">{{ @$product->Category->name}}</div>
  </div>

  <div class="row m-0">
    <div class="col col-3 text-end"> Barcode: </div>
    <div class="col col-9 border-start">{{ $product->barcode }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> price: </div>
    <div class="col col-9 border-start">{{ $product->price }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Unit: </div>
    <div class="col col-9 border-start">{{ @$product->unit->name }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Created By: </div>
    <div class="col col-9 border-start"> {{@$product->creator->name }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Date Created At: </div>
    <div class="col col-9 border-start">{{ $product->created_at }}</div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Edited By: </div>
    <div class="col col-9 border-start">{{@$product->editor->name}} </div>
  </div>
  <div class="row m-0">
    <div class="col col-3 text-end"> Date Modified: </div>
    <div class="col col-9 border-start">{{ $product->updated_at }}</div>
  </div>
</div>