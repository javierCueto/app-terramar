@extends('layouts.public')
@section('title','Inicio')

@section('content')

<div class="wrapper">
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('{{ asset('assets/img/fabio-mangione.jpg') }}');">
        <div class="filter"></div>
    </div>              
</div>


<nav class="navbar navbar-expand-md bg-dark">
  <div class="container">
      <button class="navbar-toggler navbar-toggler-right burger-menu" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-building"></i> {{$companie->name}}</a>
      <div class="collapse navbar-collapse" id="navbar-primary">
        <ul class="navbar-nav ml-auto">
          @if(!count($documents)==0)
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-pdf-o"></i> Descargar facturas</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#empresaModal"><i class="fa fa-building"></i> Editar empresa</a>
          </li>
        </ul>
      </div>
  </div>
</nav>
<br>
<br>
<br>



<div class="container">  
  <div class="row">
    <div class="col-md-12">
         
      @if(session('notification'))
      <div class="alert alert-success">
        {{session('notification')}}
      </div>
      @endif

      @if(!count($documents)==0)

        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Dueño</th>
              <th scope="col">Nombre</th>
              <th scope="col">url</th>
              <th scope="col">Fecha de carga</th>
            </tr>
          </thead>
           
          <tbody>

            @foreach($documents as $key => $document)
                

            <tr>
              <th scope="row">{{$key=$key+1}}</th>
              <td>{{$document->name_user}}</td>
              <td>{{$document->name}}</td>
              <td>
                    <a class="text-danger" href="{{url($document->url.$document->document)}}">{{$document->document}}</a>
              </td>
              <td>{{$document->created_at->format('d/m/Y')}}</td>

            </tr>
            @endforeach
           
          </tbody>
        </table>

        {{$documents->links()}}
      
      @else
      <br>
      <br>
      <br>
      <br>
      <div class="alert alert-info">
          <div class="container">
              <span>No cuenta con ningun documento cargado :) </span>
          </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      @endif
          
    </div>
  </div>
    
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Rango de fecha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <form action="{{ url('create-zip')}}" method="post">
            <div class="modal-body">

              
                  @csrf
            <div class="form-group">
              <label for="fechainial">Fecha Inicial</label>
              <input type="date" class="form-control" id="fechainicial" name="fechainicial" placeholder="" required="">
              <input type="hidden" class="form-control" id="douwload" name="download" value="zip">
            </div>

            <div class="form-group">
              <label for="fechafianal">Fecha Final</label>
              <input type="date" class="form-control" id="fechafinal" name="fechafinal" placeholder="" required="">
            </div>
             <input type="hidden" class="form-control" id="idem" name="idem" placeholder="Nombre de la empresa" value="{{$companie->id}}" required="">


            </div>
            <div class="modal-footer">
                <div class="left-side">
           
              <button class="btn btn-danger" type="submit" >Download ZIP</button>
          
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


<!-- Modal -->
<div class="modal fade" id="empresaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Rango de fecha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <form action="{{ url('/system/companie/edit/'.$companie->id)}}" method="post">
            <div class="modal-body">

               {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Nombre de la empresa</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la empresa" value="{{$companie->name}}" required="">
                </div>


                <div class="form-group">
                  <label for="email">Email donde se notificara</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required="" value="{{$companie->email}}">
                </div>

            </div>
            <div class="modal-footer">
                <div class="left-side">
           
              <button class="btn btn-danger" type="submit" >Guardar</button>
          
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

