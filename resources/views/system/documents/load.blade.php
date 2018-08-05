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
    <h1 class="display-3">Carga de archivos</h1>
  </div>
</div>


<div class="div ">
  <div class="container ">
    <div class="row">
      <div class="col md-3"></div>
      <div class="col-md-6">

        <div class="card text-white bg-dark" style="border-radius: 0">
          <div class="card-body">

            <form action="{{url('system/document')}}" method="post" enctype="multipart/form-data" class="">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Nombre del archivo</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del archivo" required="">
                </div>

                <div class="form-group">
                  <label for="document">Example file input</label>
                  <input type="file" class="form-control-file" id="document" name="document" required="">
                </div>

                 <button class="btn btn-danger">Guardar</button>

                
              </form>

          </div>
        </div>
        
      </div>
      <div class="col md-3"></div>
    </div>
  </div>
</div>





@include('includes.footer')
@endsection

