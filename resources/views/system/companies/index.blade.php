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
    @if($available!=0)

    <h2>{{$available}} empresas disponibles</h2>
    <button type="button" class="btn btn-outline-default btn-round" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-building"></i> Alta empresa
  @else
      <h2><i class="fa fa-building"></i> Empresas</h2>
  @endif

</button>
  </div>
</div>


<div class="container">  
  <div class="row">
   @if(count($companies)==0)
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">No tienen ninguna empresa dada de alta</h5>
        </div>
      </div>
    </div>
  @else
    @foreach($companies as $companie)
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-building"></i>  {{$companie->name}}</h5>
            <p class="card-text">{{$companie->name_short}}</p>
            <a href="{{url('system/companie/'.$companie->name_short.'/documents')}}" class="btn btn-primary">Ir a la empresa</a>
          </div>
        </div>
      </div>
    @endforeach

  @endif




  </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Nueva empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newCompanie" method="post" class="" action="{{url('/system/companie')}}">
            <div class="modal-body">

              
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Nombre de la empresa</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la empresa" required="">
                </div>

                <div class="form-group">
                  <label for="name_shot">*Nombre corto</label>
                  <input type="text" class="form-control" id="name_short" name="name_short" placeholder="Nombre corto" required="">
                </div>

                <div class="form-group">
                  <label for="email">Email donde se notificara</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required="">
                </div>

            </div>
            <div class="modal-footer">
                <div class="left-side">
                    <button  class="btn btn-default btn-link"  id="btnNewCOmpanie">Guardar</button>
                </div>
                <div class="divider"></div>
                <div class="right-side">
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
              </form>
        </div>
    </div>
</div>



@include('includes.footer')
@endsection

