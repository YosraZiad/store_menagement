
<div class="bulk border-bottom border-top border-dark p-0 m-3" style="">
    <div class="row m-0">
        <div class="col col-3 text-end"> Name: </div>
        <div class="col col-9 border-start">{{ $company->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Address: </div>
        <div class="col col-9 border-start">{{ $company->address }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Company Size: </div>
        <div class="col col-9 border-start">{{ $company->company_size }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Phone Number: </div>
        <div class="col col-9 border-start">{{ $company->phone_number }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Incorporation Date: </div>
        <div class="col col-9 border-start">{{ $company->incorporation_date }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Industry: </div>
        <div class="col col-9 border-start">{{ $company->industry }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Website: </div>
        <div class="col col-9 border-start">{{ $company->website }}</div>
    </div>
  
    <div class="row m-0">
        <div class="col col-3 text-end"> Created By: </div>
        <div class="col col-9 border-start"> {{@$company->creator->name }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Created At: </div>
        <div class="col col-9 border-start">{{ $company->created_at }}</div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Edited By: </div>
        <div class="col col-9 border-start">{{@$company->editor->name}}  </div>
    </div>
    <div class="row m-0">
        <div class="col col-3 text-end"> Date Modified: </div>
        <div class="col col-9 border-start">{{ $company->updated_at }}</div>
    </div>
</div>

