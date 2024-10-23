
<div class="bulk border-bottom border-top border-dark p-0 m-3" style="">
    <div class="row m-0">
        <div class="col col-3 text-end"> Name: </div>
        <div class="col col-9 border-start">{{ $category->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Description: </div>
        <div class="col col-9 border-start">{{ $category->brief }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Parent: </div>
        <div class="col col-9 border-start">{{ $category->parent }}</div>
    </div>
  
    <div class="row m-0">
        <div class="col col-3 text-end"> Created By: </div>
        <div class="col col-9 border-start"> {{@$category->creator->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Created At: </div>
        <div class="col col-9 border-start">{{ $category->created_at }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Edited By: </div>
        <div class="col col-9 border-start">{{@$category->editor->name}}  </div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Modified: </div>
        <div class="col col-9 border-start">{{ $category->updated_at }}</div>
    </div>
</div>

