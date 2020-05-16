@extends('layouts.app')
@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/carrito_de_compras.jpg') }})">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand text-center">
            <h1>Administración de pedidos</h1>
            <h3 class="title text-center">Sus clientes tienen  pedidos de compra</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Registro de producto -->
    <div class="main main-raised">
        <div class="section container">
          <h4 class="title text-center"> ¡Hola, {{ Auth::user()->name }}! </h4>
          <hr>
            @if (session('notification'))
                <div class="alert alert-success text-center">
                    {{ session('notification') }}
                </div>
            @endif
    
            <!-- start nav pills -->
            <ul class="nav nav-pills nav-pills-icons" role="tablist">
                   
                <li class="nav-item active">
                    <a class="nav-link active" href="#orders" role="tab" data-toggle="tab">
                        <i class="material-icons">schedule</i>
                       Ardministración de Pedidos
                    </a>
                </li>
    
                @if(auth()->user()->admin)
                <li class="nav-item">
                    <a class="nav-link" href="#messages" role="tab" data-toggle="tab">
                        <i class="material-icons">message</i>
                        Mensajes
                    </a>
                </li>
                @endif
            </ul>
    
    
            <div class="tab-content tab-space">                  
    
                <!-- Pedido s -->
                <div class="tab-pane active" id="orders">    
                    @yield("content_dashboard_orders")
    
                    @if(count($carts) > 0)
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="col-md-2">Código</th>
                                <th  class="col-md-2">Estado</th>
                                <th class="col-md-2">Orden</th>
                                <th class="col-md-2">Recibido</th>
                                <th class="col-md-2">Total</th>
                                <th class="text-rigth">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- recorriendo cada item del pedido-->
                            @foreach($carts as $order)
                            <tr>
                                <td>{{ $order->code }}</td>
                                <th>{{ $order->status }}</th>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->arrived_date }}</td>
                                <td class="td-actions ">&dollar; {{ $order->total }} </td>
                                <td class="td-actions">
                                   {{--    <button type="button" rel="tooltip" title="Detalles"
                                     class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                     data-toggle="modal" data-target="#productsModal">
                                        <i class="material-icons">list</i>
                                    </button>  --}}   
                                <a href="{{route('pedidos.show',$order->code)}}" rel="tooltip" 
                                    title="Ver detalles"
                                     class="btn btn-info btn-fab btn-fab-mini btn-round" 
                                    >
                                        <i class="material-icons">remove_red_eye</i>
                                   </a>   
                        
                                    @if(auth()->user()->admin)
                                        <button type="button" rel="tooltip" title="Cambiar status" class="btn btn-success btn-fab btn-fab-mini btn-round" data-toggle="modal" data-target="#statusModal">
                                                <i class="material-icons">assignment</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Enviar mensaje" class="btn btn-light btn-fab btn-fab-mini btn-round" data-toggle="modal" data-target="#messageModal">
                                                <i class="material-icons">reply</i>
                                        </button>
                                    @endif  
                                    <button type="submit" rel="tooltip" title="Cancelar pedido" class="btn btn-danger btn-fab btn-fab-mini btn-round"data-toggle="modal" data-target="#confirmModal">
                                        <i class="fa fa-times"></i>
                                    </button> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="row">
                        <div class="col-md-12">  
                            <div class="info">
                                <div class="icon icon-info text-center">
                                    <i class="material-icons">info</i>
                                </div>
                                <div class="text-center"><h2>No hay pedidos aqui por ahora</h2></div>
                            </div> 
                        </div>
                    </div>
                    @endif
                </div>
                <!-- End Pedidos -->
    
                <!-- Mensajes -->
                @if(auth()->user()->admin)
                <div class="tab-pane" id="messages">   
                    @yield("content_dashboard_messages")
    
                </div>
                @endif
                <!-- End mensajes -->
    
            </div>
        </div>
      </div>
      <!--end principal content-->
    
    
    
    <!-- Modal Products -->
    <div class="modal fade" id="productsModal" tabindex="-1" role="dialog"
     aria-labelledby="productsModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="text-center modal-title "
                   id="exampleModalLongTitle">Mostrando productos del pedido</h5>
                  <button type="button" class="close" data-dismiss="modal"
                   aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Producto</th>
                              <th>Precio</th>
                              <th>Cantidad</th>   
                          </tr>
                      </thead>
                      <tbody>
                      <?php $sum=0; 
                      ?>  
                          @if(auth()->user()->orderDetails)
                             
                              @foreach(auth()->user()->orderDetails->details as $detail)
                              <tr>
                                  <td>{{ $detail->product->name }}</td>
                                  <td>&dollar;{{ $detail->product->price }}</td>
                                  <td>{{ $detail->quantity }}</td>
                                  
                                  <?php $sum+=$detail->product->price*  $detail->quantity ;
                                ?>
                                  
                              </tr>
                              @endforeach
                          @endif
                            <tr>
                                <th class="bg-warning">Total a pagar</th>
                                <th class="bg-warning"></th>
                                <th class="bg-warning">  &dollar; {{$sum}}</th>
                            </tr>
                      </tbody>
                  </table>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
    
    <!-- Modal Menssage -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Enviar mensaje </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="contact-form" method="post" action="#">
    
                    <div class="form-group">
                        <label class="bmd-label-floating">Asunto</label>
                        <input type="text" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label class="bmd-label-floating" value="">Correo Electronico</label>
                        <input type="email" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="exampleMessage" class="bmd-label-floating">Mensaje</label>
                        <textarea type="email" class="form-control" rows="4" id="exampleMessage"></textarea>
                    </div>
    
                    <div class="row">
                    <div class="col-md-4 ml-auto mr-auto text-center">
                        <button class="btn btn-primary btn-raised">
                        Enviar
                        </button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Status -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar estado del pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ url('/order/status') }}">
                {{ csrf_field() }}
                <label for="inputState">Status</label>
                <select id="inputState" name="status" class="form-control">
                    <option selected>Pendiente</option>
                    <option>Aprobado</option>
                    <option>Finalizado</option>
                    <option>Cancelado</option>
                </select>
                <button type="submit" class="btn btn-primary ml-auto mr-auto text-center">Actualizar</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Confirm delete -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">¿Esta seguro que desea eliminar este pedido?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <form method="post" action="{{ url('/order') }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-primary ml-auto mr-auto text-center">Confirmar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>


{{--    <div class="main main-raised">
    <div class="container">
        <div class="section">
            <h2 class="title"></h2>
            <div class="">
                <div class="row">
                    <div class="col-md-6"  >
                            <!-- Card blog -->
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                    <div class="col-md-3 mb-auto mt-auto" >
                        <h3>Mas compradas</h3>
                            <!-- Card blog -->
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                    <div class="col-md-3 mb-auto mt-auto" >
                            <!-- Card blog -->
                            <h3>Nueva</h3>
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                </div>
                <!-- end row --> 
                <div class="row">
                    <div class="col-md-4"  >
                            <!-- Card blog -->
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                    <div class="col-md-4" >
                            <!-- Card blog -->
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                    <div class="col-md-4" >
                            <!-- Card blog -->
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                            <!-- End Card Blog -->
                    </div>

                </div>
                
                
            </div>
            <!-- end team -->
        </div>
        <!-- end section -->
    </div>
    <!-- end container -->
  </div>
  <!-- end main -->  --}}

@endsection