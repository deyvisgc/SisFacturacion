
<div class="modal fade" id="modalUsuario"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form id="frm" action="{{url('Pagar')}}">
                <div class="modal-header custom-modal-title">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white">NUEVO REGISTRO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card-box col-lg-12 col-xl-12">
                            <ul class="nav nav-pills navtab-bg nav-justified">
                                <li class="nav-item">
                                    <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        INICIO DE SESION
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link">
                                       DATOS PERSONALES
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="aboutme">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-box text-center">
                                                <label for="file">
                                                    <img src="assets/images/users/user-1.jpg" id="imagen" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                                </label>
                                                <input type="file" name="something" id="file"  style="display:none;">
                                                <h4 class="mb-0">Geneva McKnight</h4>
                                                <p class="text-muted">@webdesigner</p>
                                            </div> <!-- end card-box -->
                                        </div>
                                        <div class="col-md-8">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Usuario</label>
                                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Contraseña</label>
                                                        <input type="password" class="form-control" id="clave" placeholder="Enter last name">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Comfirmar Contraseña</label>
                                                        <input type="password" id="confir_clave" name="confir_clave" class="form-control" placeholder="**********">
                                                        <span id='message'></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Rol</label>
                                                        <select class="form-control select2" id="rol" style="width: 235px" placeholder="Search">
                                                            @foreach($rol as $r)
                                                                <option value="{{$r->id_rol}}">{{$r->nombre_rol}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div> <!-- end tab-pane -->
                                <!-- end about me section content -->

                                <div class="tab-pane show" id="timeline">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-fb">Nombre</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nombre" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-tw">Apellidos</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="apellidos" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-insta">Telefono</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="telefono" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-lin">DNI</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="dni" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-sky">CORREO</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-skype"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="correo" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="social-gh">Fecha Nacimiento</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-github"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fecha_nacimiento" placeholder="Escribe aqui.......">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                        <div class="text-right">
                                            <button type="button" class="btn btn-success waves-effect waves-light mt-2" id="regisusuario"><i class="mdi mdi-content-save"></i>Guardar</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- end timeline content-->


                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

