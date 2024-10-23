<div class="bulk border-bottom border-top border-dark p-0 m-3" style="">
    @if ($unit)
        <div class="row m-0">
            <div class="col col-3 text-end"> Name: </div>
            <div class="col col-9 border-start">{{ $unit->name }}</div>
        </div>
        <div class="row m-0">
            <div class="col col-3 text-end"> Description: </div>
            <div class="col col-9 border-start">{{ $unit->description }}</div>
        </div>
        <div class="row m-0">
            <div class="col col-3 text-end"> Short Name: </div>
            <div class="col col-9 border-start">{{ $unit->short_name }}</div>
        </div>

        <div class="row m-0">
            <div class="col col-3 text-end"> Created By: </div>
            <div class="col col-9 border-start"> {{ @$unit->creator->name }}</div>
        </div>
        <div class="row m-0">
            <div class="col col-3 text-end"> Date Created At: </div>
            <div class="col col-9 border-start">{{ $unit->created_at }}</div>
        </div>
        <div class="row m-0">
            <div class="col col-3 text-end"> Edited By: </div>
            <div class="col col-9 border-start">{{ @$unit->editor->name }} </div>
        </div>
        <div class="row m-0">
            <div class="col col-3 text-end"> Date Modified: </div>
            <div class="col col-9 border-start">{{ $unit->updated_at }}</div>
        </div>
    @else
        error
    @endif


</div>
