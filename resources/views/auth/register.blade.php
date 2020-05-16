@extends('layouts.app')

@section('content')

 <!--El header, con la imagen de fondo ocupa una 
  toda la pantalla, incluido el footer
  El header engloba al contenido y al footer-->
  
  <div class="page-header header-filter" style="background-image: url({{ asset('/img/login.jpg') }}); background-size: cover; background-position: top center;">
    <!--Start container of form-->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 ml-auto mr-auto">
          
          <!--tarjeta que contiene al form-->
          <div class="card card-login">
            <!--Start form-->
            <form class="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="card-header-success w-50 align-content-center rounded-right text-center">
                <h4 class="card-title">Registrate</h4>
              </div>
             
              <p class="description text-center">Registrate para disfrutar de nuestros productos</p>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                     <!-- Nombre -->
                <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                    <i class="material-icons">face</i>
                    </span>
                                     
                    <input id="name" type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- End Nombre -->
                    </div>
                    <div class="col-sm-6">
             <!-- Phone-->
             <div class="input-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                        <i class="material-icons">phone</i>
                    </span>                  
                    <input id="phone" type="text" class="form-control" name="phone" maxlength="10" placeholder="Celular" value="{{ old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- End Phone -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                             <!-- Mail -->
                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                        <i class="material-icons">mail</i>
                    </span>                  
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- End Mail -->
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-sm-12">
                     <!-- Direciton-->
                <div class="input-group{{ $errors->has('direction') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                        <i class="material-icons">home</i>
                    </span>                  
                    <textarea id="direction" class="form-control" name="direction" placeholder="Dirección de contacto" value="{{ old('direction') }}" required></textarea>
                    @if ($errors->has('direction'))
                        <span class="help-block">
                            <strong>{{ $errors->first('direction') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- End direction -->
                    </div>
                   
                </div>
               <div class="row">
                   <div class="col-sm-6">
                     <!-- Password -->
                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>    
                    <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif      
                </div>
                <!-- End Password -->
                   </div>
                   <div class="col-sm-6">
                      <!-- Confirm Password -->
                <div class="input-group">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                    <input id="password-confirm" type="password" class="form-control"  placeholder="Confirmar Contraseña" name="password_confirmation" required>
                </div>
                <!-- End Confirm Password -->

                </div>
               </div>

              </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-primary btn-wd  btn-sm">    <i class="material-icons">beenhere</i>   Comenzar</button>
                    <!-- <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</a> -->
                </div>
            </form>
            <!-- End form-->

          </div>    
        </div>
      </div>
    </div>
    <!-- End container of form-->
  </div>
@endsection


                <!-- Nombre 
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="material-icons">face</i>
                            </span>
                        </div>             
                        <input id="name" type="text" class="form-control" name="name" placeholder="First Name..." value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                Modelo original

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password...">
                </div>
                <!-- end nombre -->



<!-- 

<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
