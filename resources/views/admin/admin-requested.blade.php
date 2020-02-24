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
                            <th>Series</th>
                            <th>Requestor</th>
                            <th>Project</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prform as $key => $row)
                        <tr>
                            <td style="display: none;">{{$row->pr_id}}</td>
                            <td>{{++$key}}</td>
                            <td>{{Carbon\Carbon::parse($row->date)->format('m-d-Y')}}</td>
                            <td>{{$row->series}}</td>
                            <td>{{$row->requestor}}</td>
                            <td>{{$row->project}}</td>
                            <td>
                                <a href="{{route('view.admin-prform', [$id=$row->pr_id, $requestor=$row->requestor])}}" style="cursor: pointer; color: #51cbce;" class="approveData" data-content="View Request" rel="popover" data-placement="bottom">
                                    <i class="fas fa-eye" style="font-size: 20px;"></i>
                                </a>&nbsp;
                                <span style="cursor: pointer; color:red;" class="deleteData" data-content="Remove" rel="popover" data-placement="bottom">
                                    <i class="fas fa-trash" style="font-size: 20px;"></i>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="status" style="display: none;">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="hidden" id="status_id" name="status_id" value="">
</form>

{{$prform->links()}}

@endsection

@section('scripts')
<script type="text/javascript">
    $('.approveData').popover({trigger : "hover focus"});
    $('.deleteData').popover({trigger : "hover focus"});

    $('.deleteData').on('click', function(){
        
        let tr = $(this).closest('tr');
        let data = tr.children('td').map(function(){
            return $(this).text();
        }).get();

        $('#status_id').val(data[0]);

        let status_id = $('#status_id').val();

        $('.overlay').show();
        $.ajax({
            url: "{{route('admin.remove')}}",
            type: "PUT",
            data: $('#status').serialize(),
            success: function(){
                $('.overlay').hide();
                swal("Success", "Successfully Removed", "success").then(function(){
                    $('.overlay').show();
                    location.reload();
                }); 
            },
            error: function(){
                $('.overlay').hide();
                swal('Error', "Something went wrong, Please try again", "error");
            }
        });
    });
</script>
@endsection
