@extends('layouts.public')
@section('title','Inicio')

@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
 
@endsection

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
      <a class="navbar-brand" href="#"><i class="fa fa-building"></i> Administración de usuario</a>
      <div class="collapse navbar-collapse" id="navbar-primary">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-building"></i> Nuevo usuario</a>
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
        <table id="usersTable" class="display table">
          <td>
            <thead class="thead-dark">
              <tr>
                  <th >Nombre de usuario</th>
                  <th>Empresa</th>
                  <th>Rol</th>
                  <th>Email</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          </td>

        </table>
        <br>
        <br>
                  

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

@section('scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <script>
      var edit="{{url('/')}}"


      $(document).ready(function() {

            var table= $('#usersTable').DataTable( {
                "ajax": '{{url("/api/user")}}',
                "columns": [

                    { data: "userName" },
                    { data: "companieName" },
                    { data: "roleName" },
                    { data: "userEmail" },
                    {"defaultContent": '<button type="button" id="ButtonEditar" class="editar edit-modal btn btn-warning botonEditar"><span class="fa fa-edit"></span><span class="hidden-xs"> Editar</span></button>'}
                ],

                "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  }

          
            } );

            $('#usersTable tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
         //table.ajax.reload();
         alert('Lo estamos trabajando :)');
        //alert( data.id +"'s salary is: "+ data[ 5 ] );
    } );


        } );
    </script>
 
@endsection

