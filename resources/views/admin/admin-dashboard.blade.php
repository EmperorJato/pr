@extends('layouts.admin-prf')

@section('search')
<form action="{{route('search-request')}}" method="GET" class="form-inline md-form form-sm mt-0">
    <div class="input-group no-border">
        <input type="search" id="search" name="search" value="" class="form-control" placeholder="Search...">
        <div class="input-group-append">
            <button type="submit"  class="btn-sm btn-outline-info"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table">
                    <thead class=" text-primary">
                        <tr>
                            <th style="display: none;">ID</th>
                            <th>#</th>
                            <th>Date</th>
                            <th>Project</th>
                            <th>Usage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- {{$prform->links()}} --}}

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
