<h4>{{ $role->display_name }}</h4>

<div class="bulk border-bottom border-top border-dark p-0 m-3" style="">
    <div class="row m-0">
        <div class="col col-3 text-end"> Role Name: </div>
        <div class="col col-9 border-start">{{ $role->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Role Guard Name: </div>
        <div class="col col-9 border-start">{{ $role->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Role Display Name: </div>
        <div class="col col-9 border-start">{{ $role->display_name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Description:</div>
        <div class="col col-9 border-start">{{ $role->brief }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Created By: </div>
        <div class="col col-9 border-start">{{ $role->creator->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Created At: </div>
        <div class="col col-9 border-start">{{ $role->created_at }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Edited By: </div>
        <div class="col col-9 border-start">{{ @$role->editor->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Modified: </div>
        <div class="col col-9 border-start">{{ $role->updated_at }}</div>
    </div>
</div>
