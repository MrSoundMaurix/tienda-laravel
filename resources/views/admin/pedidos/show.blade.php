@extends('layouts.app')

@section('title','Shopping Market | DETAALES')
@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!--jumbotron-->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/categoria.jpg') }})">
  </div>
  <!-- end jumbotron-->

  <!-- contenido del perfil -->
  <div class="">
    <div class="">
      <div class="">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
          
            <div class="card">
              <div class="card-header">
              
                <h5 class="card-title">Detalles de compra</h5>
              </div>
              <div class="card-body  text-center">
                <h3>Datos del usuario</h3>
                  <hr>
                <div class="row">
                  
                <div class="col-sm-6">
                   
                
                 <h5 class="card-title text-left">Nombre: 
                  <label for="">{{$usuario[0]->name}}</label>
                </h5>
                 <h5 class="card-title  text-left">Correo: 
                  <label for="">{{$usuario[0]->email}}</label>
                </h5>
                
                  </div>
                  <div class="col-sm-6">
                    <h5 class="card-title  text-left">Celular: 
                      <label for="">{{$usuario[0]->phone}}</label>
                    </h5>
                    <h5 class="card-title  text-left">Dirección: 
                      <label for="">{{$usuario[0]->direction}} </label>
                    </h5>
                  </div>
                 
                </div>
                <br>
                <h3>Productos de compra</h3>
                  <hr>
                <div class="row">

                  <table class="table table-responsive-md">
                    <thead>
                        <tr>
                            <th class="col-md-2">Producto</th>
                            <th  class="col-md-2">Precio</th>
                            <th class="col-md-2">Cantidad</th>
                            <th class="col-md-2">Subtotal</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sum=0;
                      ?>
                  @foreach($detalles as $det)
                            <tr>
                               <?php 
                                $price=0;
                                ?>
                                @foreach ($products as $p)

                                @if ($det->product_id==$p->id)
                                <td>{{ $p->name }}  
                                </td>
                                <td>{{ $p->price }}  
                                 
                                </td>
                                <?php 
                                $price= $p->price ;
                                ?>
                                @endif
                               
                                @endforeach
                                
                               
                                <td>{{ $det->quantity }}</td>
                                <td>{{ $det->quantity*$price }}</td>
                                <?php 
                                $sum+= $det->quantity*$price;
                                ?>
                                
                            </tr>
                            @endforeach

                            <tr>
                              <th class="bg-warning">Total a pagar</th>
                              <th class="bg-warning"></th>
                              <th class="bg-warning"></th>
                              <th class="bg-warning">  &dollar; {{$sum}}</th>
                          </tr>
                    </tbody>
                  </table>
              {{--    <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
  --}}              
                <a href="{{url('/admin/pedidos')}}" class="btn btn-primary">
              <i class="material-icons">arrow_back</i>
              Regresar</a>
              </div>
          </div>
        </div>

        <div class="">
         
                </div>
                <div class="text-center">
                 {{--   {{ $products->links("pagination::bootstrap-4") }}  --}}
              </div>
              </div>
            </div>
            <!--End container -->
          </div>
        </div>
  <!--end contenido del perfil-->
@endsection