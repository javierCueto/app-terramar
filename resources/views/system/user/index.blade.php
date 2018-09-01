@extends('layouts.public')
@section('title','Inicio')

@section('content')

<div class="wrapper">
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('{{ asset('assets/img/fabio-mangione.jpg') }}');">
        <div class="filter"></div>
    </div>              
</div>

<div class="jumbotron jumbotron-fluid no-margin">
  <div class="container">
    <h1>Administración de usuario</h1>
  </div>
</div>

<div class="jumbotron jumbotron-fluid bg-dark">
  <div class="container">
    <h2>  <button type="button" class="btn btn-outline-danger " data-toggle="modal" data-target="#myModal">Nuevo usuario</button></h2>
  </div>
</div>


<div class="container">  
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>
    
</div>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newCompanie" method="post" class="" action="{{url('/system/user')}}">
            <div class="modal-body">

              
                {{csrf_field()}}
                
               <div class="form-group">
                  <label for="rol">Tipo de usuario</label>
                  <select class="form-control" name="rol" id="rol" required="">
                  <option value="">Selecione un rol</option>
                  @foreach($roles as $rol)
                  <option value="{{$rol->id}}">{{$rol->name}}</option>
                  @endforeach
                </select>
                </div>


                 <div class="form-group">
                  <label for="rol">Empresa a la que pertenece</label>
                  <select class="form-control" name="companie" id="companie" required="">
                  <option value="">Selecione una empresa</option>
                  @foreach($companies as $com)
                  <option value="{{$com->id}}">{{$com->name}}</option>
                  @endforeach
                </select>
                </div>


                <div class="form-group">
                  <label for="name" >{{ __('Nombre') }}</label>
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                </div>

                
                

                <div class="form-group">
                  <label for="email" >{{ __('E-Mail') }}</label>
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                </div>
                
                <div class="form-group">
                 
                                        <label for="password" >{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif

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

