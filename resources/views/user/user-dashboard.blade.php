@extends('layouts.prf')

@section('content')


  <div class="overlay">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
  </div>
  
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-list-ul text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Request</p>
                <p class="card-title">{{$req}}
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fas fa-eye"></i> <a href="{{route('user-request')}}" style="text-decoration: none;">View</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-tasks text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Requested PR</p>
                <p class="card-title">{{$requested}}
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fas fa-eye"></i> <a href="{{route('user-requested')}}" style="text-decoration: none;">View</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-thumbs-up text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Approved PR</p>
                <p class="card-title">{{$approved}}
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fas fa-eye"></i> <a href="{{route('user-approved')}}" style="text-decoration: none;">View</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-thumbs-down text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Rejected PR</p>
                <p class="card-title">{{$rejected}}
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fas fa-eye"></i> <a href="{{route('user-rejected')}}" style="text-decoration: none;">View</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    @if(isset($last_pr))
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Your last PRF:</h4>
        </div>
        <div class="card-body">
          <div class="text-center">
            <p>{{$last_requested}}</p>
            <h1><span>&#8369; </span><span id="grandTotal">@money($last_total)</span></h1>
            @if($status == "Approved")
            <h5 class="text-success"><i class="fas fa-check"></i> Approved</h5>
            <a href="{{route('view.prform', [$id=$send->pr_id, $requestor=$send->requestor])}}" type="button" class="btn btn-primary" id="send_btn"><i class="fas fa-eye"></i>&nbsp; view</a>
            @elseif($status == "Rejected")
            <h5 class="text-danger"><i class="fas fa-times"></i> Rejected</h5>
            <a href="{{route('user-send', [$id=$send->pr_id, $requestor=$send->requestor])}}" type="button" class="btn btn-primary" id="send_btn"><i class="fas fa-eye"></i>&nbsp; view</a>
            @elseif($status == "Requested")
            <h5 class="text-primary"><i class="fas fa-mug-hot"></i> Pending</h5>
            <a href="{{route('user-edit', [$id=$send->pr_id, $series=$send->series])}}" type="button" class="btn btn-primary" id="send_btn"><i class="fas fa-eye"></i>&nbsp; view</a>
            @else
            <h5> You did not send this PRF</h5>
            <a href="{{route('user-send', [$id=$send->pr_id, $requestor=$send->requestor])}}" type="button" class="btn btn-primary" id="send_btn"><i class="fas fa-eye"></i>&nbsp; view</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Grand Total of your Approved PRF:</h4>
        </div>
        <div class="card-body">
          <div class="text-center">
            @if(isset($app))
            <h1><span>&#8369; </span><span id="grandTotal">@money($grand)</span></h1>
            @else
            <h1><span>&#8369; </span><span id="grandTotal">0.00</span></h1>
            @endif
            <a href="{{route('user-form')}}" type="button" class="btn btn-primary"><i class="fas fa-sticky-note"></i>&nbsp; ADD PRF</a>
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
