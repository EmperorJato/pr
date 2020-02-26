@extends('layouts.admin-prf')

@section('content')
<div class="overlay">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>
<div class="card">
    @if(isset($prforms))
    <div class="card-header" style="margin-bottom: -12px;">
        <input type="hidden" id="requestor" name="requestor" value="{{$prforms->requestor}}">
        <h3 class="card-title text-center">{{$prforms->requestor}}</h3>
        <div class="text-center">
            Series No: {{$prforms->series}}<br>
            Request Date: {{Carbon\Carbon::parse($prforms->date)->format('m/d/Y')}}
            
        </div>
    </div>
    <div class="card-body">
        <hr>
        <form id="save_pr">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" id="pr_id" name="pr_id" value="{{$prforms->pr_id}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <p for="department" style="font-size: 18px;">Department: </p>
                <input type="text" class="form-control" id="department" name="department" value="{{$prforms->department}}" style="background-color: #fff;" readonly>
            </div>
            <div class="form-group col-md-6">
                <p for="project" style="font-size: 18px;">To be used in <i style="font-size: 12px;">(Project Name)</i> :</p>
                <input type="text" class="form-control" id="project" name="project" value="{{$prforms->project}}" style="background-color: #fff;" readonly>
            </div>
        </div><br>
        <div class="form-row">
            <div class="form-group col-md-12">
                <p for="purpose" style="font-size: 18px;">Specific Purpose or Usage: </p>
                <input type="text" class="form-control" id="purpose" name="purpose" value="{{$prforms->purpose}}" style="background-color: #fff;" readonly>
            </div>
        </div>
    </form>
    </div>
    @else
    <h4 class="text-center">No Product Found</h4>
    @endif
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="text-primary">
                        <tr>
                            <th style="display: none;">ID</th>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @foreach($products as $key => $row)
                        <tr>
                            <td style="display: none;">{{$row->p_id}}</td>
                            <td class="key">{{++$key}}</td>
                            <td>{{$row->product}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>{{$row->unit}}</td>
                            <td class="price-currency">{{$row->price}}</td>
                            <td class="total-currency">{{$row->total}}</td>
                            <input type="hidden" class="total" value="{{$row->total}}" />
                            <td>{{$row->remarks}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Grand Total:</h4>
        </div>
        <div class="card-body">
            <form id="status">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <input type="hidden" id="status_id" name="status_id" value="">
            </form>
          <div class="text-center">
            <h1><span>&#8369; </span><span id="grandTotal">0.00</span></h1>
            <button type="button" class="btn btn-primary" id="approve_btn"><i class="fas fa-thumbs-up"></i>&nbsp; Approve</button>
            <button type="button" class="btn btn-danger" id="remove_btn"><i class="fas fa-trash"></i>&nbsp; Remove</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">

    function grandTotal(){
        var grand = 0;
        
        $('.total').each(function(i, e){
            var amount = $(this).val()-0;
            grand += amount;
        });
        
        $('#grandTotal').html(grand).formatCurrency({symbol: ''});
    }

    $('.price-currency').formatCurrency({symbol : ''});

    $('.total-currency').formatCurrency({symbol : '₱ '});

    grandTotal();

    $('#approve_btn').on('click', function(){
        let pr_id = $('#pr_id').val();
        $('#status_id').val(pr_id);
        let status_id = $('#status_id').val();
        let requestor = $('#requestor').val();
        $('.overlay').show();
        $.ajax({
            url: "{{route('admin.approve')}}",
            type: "PUT",
            data: $('#status').serialize(),
            success: function(){
                $('.overlay').hide();
                swal("Success", "Successfully Approved", "success").then(function(){
                    swal({
                        title: "View PDF",
                        text: "Would you like to print this request?",
                        icon: "info",
                        buttons: true,
                        closeOnClickOutside: false
                    }) 
                    .then((willDelete) => {
                        if (willDelete) {
                            window.open("/pr/print/"+pr_id+"/"+requestor+"", "_blank");
                            $('.overlay').show();
                            window.location.href = "{{route('admin-dashboard')}}";
                        } else {
                            $('.overlay').show();
                            window.location.href = "{{route('admin-approved')}}";
                        }
                    });
                });  
            },
            error: function(){
                $('.overlay').hide();
                swal('Error', "Something went wrong, Please try again", "error");
            }
        });
    });

    $('#remove_btn').on('click', function(){
        let pr_id = $('#pr_id').val();
        $('#status_id').val(pr_id);
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
                    window.location.href = "{{route('admin-dashboard')}}";
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
