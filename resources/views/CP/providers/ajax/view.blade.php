<div class="bulk border-bottom border-top border-dark p-0 m-3" style="">
    <div class="row m-0">
        <div class="col col-3 text-end"> Name: </div>
        <div class="col col-9 border-start">{{ $item->full_name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Field: </div>
        <div class="col col-9 border-start">{{ $fields[$item->field] }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Short Name: </div>
        <div class="col col-9 border-start">{{ $item->short_name }}</div>
    </div>

    <div class="row m-0">
        <div class="col col-3 text-end"> Created By: </div>
        <div class="col col-9 border-start"> {{ $item->creator->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Created At: </div>
        <div class="col col-9 border-start">{{ $item->created_at }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Edited By: </div>
        <div class="col col-9 border-start">{{ @$item->editor ? $item->editor->name : $item->creator->name }} </div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Modified: </div>
        <div class="col col-9 border-start">{{ $item->updated_at }}</div>
    </div>
</div>
