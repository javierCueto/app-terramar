@extends('layouts.public')
@section('title','Inicio')

@section('content')

<div class="wrapper">
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('{{ asset('assets/img/fabio-mangione.jpg') }}');">
        <div class="filter"></div>
    </div>              
</div>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h2>Carga de archivos</h2>
  </div>
</div>


<div class="div ">
  <div class="container ">
    <div class="row">
      <div class="col md-3"></div>
      <div class="col-md-6">


        <div class="alert alert-success alert-with-icon mess" style="display: none" data-notify="container">
            <div class="container">
                <div class="alert-wrapper">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="nc-icon nc-simple-remove"></i>
                    </button>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="card text-white bg-dark" style="border-radius: 0">
          <div class="card-body">
            <p class="text-center"><i class="fa fa-file-pdf-o" style="font-size:84px"></i></p>
            
            <form id="sendFile" method="post" enctype="multipart/form-data" class="">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Nombre del archivo</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del archivo" required="">
                </div>

                <div class="form-group">
                  <label for="document">Cargar archivos</label>
                  <input type="file" class="form-control-file" id="document" name="document" required="">
                </div>

                 <button class="btn btn-danger" id="sendfile">Guardar</button>

                
              </form>

          </div>
        </div>
        
      </div>
      <div class="col md-3"></div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
    
            <div class="modal-body text-enter"> 
              <h4 class="text-success">Espere lo estamos atendiendo</h4>
              <p></p>
              <p class="text-center"><i class="fa fa-spinner fa-spin" style="font-size:54px"></i> </p>
                      
            </div>
    
        </div>
    </div>
</div>


@include('includes.footer')
@endsection
@section('scripts')
<script>
  jQuery(document).ready(function(){         
    
    jQuery('#sendFile').on('submit', function(e) {
      $("#sendfile").prop("disabled", true);
      $('#myModal').modal('show');
      e.preventDefault();

      var formData = new FormData(this);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });



      jQuery.ajax({
        url: "{{ url('system/document') }}",
        method: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result){ 
          $('#myModal').modal('hide');

          jQuery('.message').html('<i class="nc-icon nc-bell-55"></i> '+result.success);

           
          jQuery('.mess').show();

           $("#sendfile").prop("disabled", false);
           $('#sendFile')[0].reset();

        },error: function(jqXHR, text, error){

          alert(jqXHR);alert(text);alert(error);
          $("#sendfile").prop("disabled", false);
          $('#myModal').modal('hide');
        }
      });

        // setTimeout(function() {
        //   jQuery('.mess').hide();
        // },3000);
    });
  });


</script>



@endsection
