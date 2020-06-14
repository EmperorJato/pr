@extends('layouts.admin-prf')

@section('content')
<div class="overlay">
  <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>
<div class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-user">
        <div class="image">
          <img src="{{asset('images/profile_bg.jpg')}}" alt="...">
        </div>
        <div class="card-body">
          <div class="author">
            <span>
              <input type="hidden" id="id_user" name="id_user" value="{{$user->id}}">
              <img class="avatar border-gray" src="{{asset('images/'.$user->user_avatar)}}" alt="...">
              <h5 class="title">{{$user->name}}</h5>
            </span>
            <hr>
            <p class="description">
              <div class="row text-left mb-3">
                <div class="col-md-4">
                    <b>Email :</b>
                </div>
                <div class="col-md-8">
                    {{$user->email}}
                </div>
              </div>
              <div class="row text-left mb-3">
                <div class="col-md-4">
                    <b>Role :</b>
                </div>
                <div class="col-md-8">
                    {{$user->user_type}}
                </div>
              </div>
              <div class="row text-left mb-3">
                <div class="col-md-4">
                    <b>Created At :</b>
                </div>
                <div class="col-md-8">
                    {{$user->created_at}}
                </div>
              </div>
              <div class="row text-left mb-3">
                <div class="col-md-4">
                    <b>Projects :</b>
                </div>
              </div>
              @foreach($projects as $key => $project)
              <div class="row text-left mb-3">
                <div class="col-md-12">
                    {{++$key.". ".$project->project}}
                </div>
              </div>
              @endforeach
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="card">
            <div class="card-header">
                <h4 class="card-title">Overall :</h4>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1>₱ @money($total)</h1>
                </div>
            </div>
          </div>
          <br>
          <div class="col-md-6">
            <p><b>Select Project</b></p>
            <select class="form-control selectProject" id="project" name="project">
              <option selected disabled>Select Project</option>
              @foreach($projects as $project)
              <option value="{{$project->project}}">{{$project->project}}</option>
              @endforeach 
            </select>
          </div>
          <br>
          <div class="col-md-12">
            <div id="result">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalProducts" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
              <select class="form-control selectProducts" id="prod_project" name="prod_project">
                <option selected disabled>Select Project</option>
                @foreach($projects as $project)
                <option value="{{$project->project}}">{{$project->project}}</option>
                @endforeach 
              </select>
            </div>
          </div>
        </div>
        
        <div id="prod_result">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

  $('#prod_project').on('change', function(){
    let val = $(this).val();
    let _token = $('input[name="_token"]').val();
    let id = $('#id_user').val();
    $('.overlay').show();
    $.ajax({
      url : "{{route('admin.get-product')}}",
      method : "GET",
      data : {val : val, _token : _token, id : id},
      success : function(res){
        $('#prod_result').html(res);
        $('.overlay').hide();
      },
      error : function(err){
        $('.overlay').hide();
        console.log(err)
      }
    });
  });

  $('.selectProject').on('change', function(){
    let val = $(this).val();
    let _token = $('input[name="_token"]').val();
    let id = $('#id_user').val();
    $('.overlay').show();
    $.ajax({
      url : "{{route('admin.get-project')}}",
      method : "GET",
      data : {val : val, _token : _token, id : id},
      success : function(res){
        $('#result').html(res);
        $('.overlay').hide();
      },
      error : function(err){
        $('.overlay').hide();
        console.log(err)
      }
    });

    let project = $( "#project option:selected" ).val();
    $(`#prod_project option[value='${project}']`).prop('selected', true);

    $.ajax({
      url : "{{route('admin.get-product')}}",
      method : "GET",
      data : {val : val, _token : _token, id : id},
      success : function(res){
        $('#prod_result').html(res);
        $('.overlay').hide();
      },
      error : function(err){
        $('.overlay').hide();
        console.log(err)
      }
    })
  });

  $(document).on('click', '#viewProducts' , function(){
    $('#modalProducts').modal('show');
  })
  
  $(window).on('load', function() {
    $(".overlay").fadeOut(200);
  });
</script>
@endsection
