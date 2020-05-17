<!--Vista de administracion de productos -->
@extends('layouts.app')

@section('title','Nuestros Productos')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
  
<!--jumbotron-->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/tiendabanner.png') }})">
  </div>
  <!-- end jumbotron-->


  <!--principal content, similar al landing page-->
  <div class="main main-raised">
    <div class="container">

      <!-- Products section -->
      <div class="section text-center">
        <h2 class="title">Listado de productos </h2>
        <div class="team">
            <div class="row">
              <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-round"> <i class="material-icons">add</i> Agregar Producto</a>              
              <table class="table table-striped table-responsive-md">
                  <thead class="badge-secondary">
                      <tr>
                        <th> Foto</th>
                        <th> Nombre</th>
                        <th> Descripción</th>
                        <th > Categoría</th>
                        <th >Precio</th>
                        <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>
                      @foreach($allProducts as $product)
                      <tr>
                        <td>
                          {{-- <img src="{{ $category->featured_image_url }}" alt="" height="50"> --}}
                      @if($product->foto == null)
                          -
                      @else
                      <img src="{{ "data:image/" . $product->fototype . ";base64," . $product->foto }}" style="max-width:95px; margin:0;">
                      @endif
                        </td>
                        <td>{{ $product->name }}</td>
                          <td> {{ $product->description }}</td>
                          <td>{{ $product->category->name  }}</td>
                          <td>&dollar; {{ $product->price }} </td>
                          <td >
                              <form method="POST" action="{{ url('/admin/products/'.$product->id.'') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <a href="{{ url('products/'.$product->id) }}" title="Ver producto" class="btn btn-info btn-simple btn-sm">
                                    <i class="material-icons">info</i>
                                </a>
                                <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" type="button"  title="Editar" class="btn btn-success
                                btn-simple btn-sm">
                                    <i class="material-icons">edit</i>
                                </a>

                               {{--  <a href="{{ url('/admin/products/'.$product->id.'/images') }}" type="button"  title="Imagenes" class="btn btn-warning
                                btn-simple btn-sm">
                                    <i class="material-icons">image</i>
                                </a>
                                 --}}
                                <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-sm
                                btn-simple">
                                    <i class="fa fa-times"></i>
                                </button>
                              </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

              <!-- pagination-->
              <div class="center-block">
                {{ $allProducts->links("pagination::bootstrap-4") }}
              </div>
             
              <!-- End pagination -->
            </div>
        </div>
    </div>
    <!--End Section text center -->

    </div>
  </div>
  <!--end principal content-->
@endsection