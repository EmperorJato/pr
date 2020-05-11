@extends('layouts.admin-prf')


@section('content')
<div class="overlay">
  <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>

<div class="row justify-content-center">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Team Members</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled team-members">
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/ayo-ogunseinde-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                DJ Khaled
                <br />
                <span class="text-muted"><small>Offline</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                Creative Tim
                <br />
                <span class="text-success"><small>Available</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/clem-onojeghuo-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-ms-7 col-7">
                Flume
                <br />
                <span class="text-danger"><small>Busy</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')
<script type="text/javascript">
  $(window).on('load', function() {
    $(".overlay").fadeOut(200);
  });
</script>
@endsection
