@extends('layouts.public')
@section('title','Inicio')

@section('content')

<div class="wrapper">
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('../assets/img/fabio-mangione.jpg');">
        <div class="filter"></div>
    </div>              
</div>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-3">Documentos cargados</h1>
    <a type="button" href="{{url('system/document/load')}}" class="btn btn-danger "><i class="fa fa-file-pdf-o"></i> Cargar documento</a>
  </div>
</div>


<div class="container">
    
       
    <div class="row">
        <div class="col-md-12">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">url</th>
                  <th scope="col">status</th>
                </tr>
              </thead>
              <tbody>

                @foreach($documents as $key => $document)
                    

                <tr>
                  <th scope="row">{{$key=$key+1}}</th>
                  <td>{{$document->name}}</td>
                  <td>
                        <a class="text-danger" href="{{url($document->url)}}">{{$document->document}}</a>
                  </td>
                  <td class="text-success">
                    @if($document->status) 
                       <i class="fa fa-check-square-o">
                    @endif  
                    </td>
                </tr>
               @endforeach
    
                
             
              </tbody>
            </table>
        </div>
    </div>
    
</div>




@include('includes.footer')
@endsection

