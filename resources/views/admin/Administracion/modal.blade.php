

<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">NUEVO REGISTRO</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
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
                                <form  class="needs-validation formaddusuario" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-fb">Nombre</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
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
                                                        <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
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
                                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                                    </div>
                                                    <input type="text" maxlength="9" onkeypress="return controltag(event)" class="form-control" id="telefono" placeholder="Escribe aqui.......">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-lin">DNI</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" maxlength="8" onkeypress="return controltag(event)" id="dni" placeholder="Escribe aqui.......">
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
                                                        <span class="input-group-text"><i class="fe-mail"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control"  id="correo" placeholder="Escribe aqui.......">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-gh">Fecha Nacimiento</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar-range"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datepicker" id="fecha_nacimiento"   data-date-autoclose="true">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger waves-effect waves-light mt-2" data-dismiss="modal"><i class="mdi mdi-content-save"></i>Cerrar</button>

                                        <button type="button" class="btn btn-success waves-effect waves-light mt-2" id="regisusuario"><i class="mdi mdi-content-save"></i>Guardar</button>
                                    </div>
                                </form>

                            </div>
                            <!-- end timeline content-->


                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->
                </div>

            </div>
            <!-- Modal footer -->


        </div>
    </div>
</div>
<div class="modal" id="updateuser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">NUEVO REGISTRO</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="card-box col-lg-12 col-xl-12">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#inciarsesion" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    INICIO DE SESION
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#datosperso" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    DATOS PERSONALES
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="inciarsesion">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-box text-center">
                                            <label for="file">
                                                <img src="assets/images/users/user-1.jpg" id="file1" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </label>
                                            <input type="file" name="file" id="files"  style="display:none;">
                                            <h4 class="mb-0" id="nombre_perfil"></h4>
                                            <p class="text-muted">@webdesigner</p>
                                        </div> <!-- end card-box -->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Usuario</label>
                                                    <input type="text" id="usuarios" name="usuario" class="form-control" placeholder="usuario">
                                                </div>
                                            </div>
                                            <input type="hidden" id="id_persona" name="id_persona" class="form-control" placeholder="usuario">
                                            <input type="hidden" id="id_user" name="iduser" class="form-control" placeholder="usuario">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastname">Rol</label>
                                                    <select class="form-control" id="rol_up">
                                                    </select>


                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div> <!-- end tab-pane -->
                            <!-- end about me section content -->

                            <div class="tab-pane show" id="datosperso">
                                <form  class="needs-validation forupdaperfil"  enctype="multipart/form-data" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-fb">Nombre</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nombre_up" placeholder="Escribe aqui.......">
                                                </div>
                                            </div>
                                        </div>
                                        <input id="id_user" type="hidden">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-tw">Apellidos</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="apellidos_up" placeholder="Escribe aqui.......">
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
                                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                                    </div>
                                                    <input type="text" maxlength="9" onkeypress="return controltag(event)" class="form-control" id="telefono_up" placeholder="Escribe aqui.......">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-lin">DNI</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" maxlength="8" onkeypress="return controltag(event)" id="dni_up" placeholder="Escribe aqui.......">
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
                                                        <span class="input-group-text"><i class="fe-mail"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control"  id="correo_up" placeholder="Escribe aqui.......">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-gh">Fecha Nacimiento</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar-range"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datepicker" id="fecha_naci_up"   data-date-autoclose="true">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </form>
                                <div class="text-right">
                                    <button type="button" class="btn btn-danger waves-effect waves-light mt-2" data-dismiss="modal"><i class="mdi mdi-content-save"></i>Cerrar</button>

                                    <button type="button" class="btn btn-success waves-effect waves-light mt-2" id="btnactualizar"><i class="mdi mdi-content-save"></i>Guardar</button>
                                </div>
                            </div>
                            <!-- end timeline content-->


                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->
                </div>

            </div>
            <!-- Modal footer -->


        </div>
    </div>
</div>

