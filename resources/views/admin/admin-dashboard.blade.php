@extends('layouts.admin-prf')


@section('content')
<div class="overlay">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-business-time text-warning"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                    <p class="card-category">Total Pending Request</p>
                  <p class="card-title">{{$pr}}
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats text-center">
              <i class="fas fa-eye"></i> <a href="{{route('admin-pending')}}" style="text-decoration: none;">View</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Grand Total of Pending PRF:</h4>
          </div>
          <div class="card-body">
            <div class="text-center">
              @if(isset($prform))
              <h1><span>&#8369; </span><span id="grandTotal">@money($total)</span></h1>
              @else
              <h1><span>&#8369; </span><span id="grandTotal">0.00</span></h1>
              @endif
            </div>
          </div>
        </div>
      </div>

</div>



@endsection

@section('scripts')
<script type="text/javascript">

 
</script>
@endsection
