<!--Vista de administracion de productos -->
@extends('layouts.app')

@section('title','Categorías')
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
        <h2 class="title">Listado de Categorías </h2>
        <div class="team">
            <div class="row">
              <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-round"> <i class="material-icons">add</i>Agregar Categoria</a>              
              <table class="table table-responsive-md table-striped">
                  <thead class="badge-secondary">
                      <tr>
                        <th > Foto</th>
                        <th > Nombre</th>
                        <th> Descripción</th>
                        <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>
                      @foreach($allCategories as $category)
                      <tr>
                        
                        <td>
                          {{-- <img src="{{ $category->featured_image_url }}" alt="" height="50"> --}}
                      @if($category->foto == null)
                          -
                      @else
                      <img src="{{ "data:image/" . $category->fototype . ";base64," . $category->foto }}" style="max-width:75px; margin:0;">
                      @endif
                        </td>
                        <td>{{ $category->name }}</td>
                          <td > {{ $category->description }}</td>
                          <td>
                              <form method="POST" action="{{ url('/admin/categories/'.$category->id.'') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <a href="{{ url('categories/'.$category->id) }}" rel="tooltip" title="Detalles de categoria" class="btn btn-info btn-simple btn-sm">
                                    <i class="material-icons">info</i>
                                </a>
                                <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" type="button" rel="tooltip" title="Editar" class="btn btn-sm btn-success
                                btn-simple">
                                    <i class="material-icons">edit</i>
                                </a>
                                
                                <button type="submit" rel="tooltip" title="Eliminar Categoria" class="btn btn-sm btn-danger
                                ">
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
                {{ $allCategories->links("pagination::bootstrap-4") }}
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