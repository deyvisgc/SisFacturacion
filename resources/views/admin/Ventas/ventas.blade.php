
@extends('partials.layout')
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-xl-8 order-xl-1 order-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-inline">
                                <div class="form-group mx-sm-3">
                                    <label for="status-select" class="mr-2"><i class="mdi mdi-cart-minus"  style="font-size: 30px;color: #1F7F6B;"></i></label>
                                    <h5>REGISTRO DE VENTAS</h5>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">

                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <div class="card">
               <i></i> <h5 class="card-header" style="background-color: #2E82C1"><label style="color: #ffffff">Datos del Cliente</label></h5>
                <div class="card-box mb-2">
                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="example-gridsize" style="color: black">MODO DE VENTA</label>
                            <select class="form-control">
                                <option selected>ELIJA DOCUMENTO</option>
                                <option value="1" >DNI</option>
                                <option value="2" >RUC</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="example-gridsize" style="color: black">Precio Compra</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precio_compra" placeholder="0.00" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="example-gridsize" style="color: black">Buscar</label>
                            <button class="ladda-button  btn btn-primary" data-style="expand-left" id="hola" value="1"><span class="ladda-label">Buscar</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
                            <button class="ladda-button  btn btn-primary" data-style="expand-left" id="btn1" style="display: none" ><span class="ladda-label">Buscar1</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px"></div></button>

                        </div>


                    </div>
                </div> <!-- end card-box-->
            </div>
            <div class="card">
                <h5 class="card-header" style="background-color: #2D6792"><label style="color: #ffffff">Datos del Producto</label></h5>
                <div class="card-box mb-2">
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="media">
                                <img class="d-flex align-self-center mr-3 rounded-circle" src="assets/images/companies/amazon.png" alt="Generic placeholder image" height="64">
                                <div class="media-body">
                                    <h4 class="mt-0 mb-2 font-16">Amazon Inc.</h4>
                                    <p class="mb-1"><b>Location:</b> Seattle, Washington</p>
                                    <p class="mb-0"><b>Category:</b> Ecommerce</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email mr-1"></i> collier@jourrapide.com</p>
                            <p class="mb-0"><i class="mdi mdi-phone-classic mr-1"></i> 828-216-2190</p>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center mt-3 mt-sm-0">
                                <div class="badge font-14 bg-soft-info text-info p-1">Hot</div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-sm-right">
                                <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-box-->
            </div>
            <div class="card-box mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="media">
                            <img class="d-flex align-self-center mr-3 rounded-circle" src="assets/images/companies/apple.png" alt="Generic placeholder image" height="64">
                            <div class="media-body">
                                <h4 class="mt-0 mb-2 font-16">Apple Inc.</h4>
                                <p class="mb-1"><b>Location:</b> Cupertino, California</p>
                                <p class="mb-0"><b>Category:</b> Ecommerce</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email mr-1"></i> deanes@dayrep.com</p>
                        <p class="mb-0"><i class="mdi mdi-phone-classic mr-1"></i> 077 6157 4248</p>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center mt-3 mt-sm-0">
                            <div class="badge font-14 bg-soft-primary text-primary p-1">Cold</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-sm-right">
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end card-box-->

            <div class="card-box mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="media">
                            <img class="d-flex align-self-center mr-3 rounded-circle" src="assets/images/companies/google.png" alt="Generic placeholder image" height="64">
                            <div class="media-body">
                                <h4 class="mt-0 mb-2 font-16">Google LLC</h4>
                                <p class="mb-1"><b>Location:</b> Menlo Park, California</p>
                                <p class="mb-0"><b>Category:</b> Search engine</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email mr-1"></i> nnac@hotmai.us</p>
                        <p class="mb-0"><i class="mdi mdi-phone-classic mr-1"></i> (216) 76 298 896	</p>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center mt-3 mt-sm-0">
                            <div class="badge font-14 bg-soft-warning text-warning p-1">In-progress</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-sm-right">
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end card-box-->

            <div class="card-box mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="media">
                            <img class="d-flex align-self-center mr-3 rounded-circle" src="assets/images/companies/airbnb.png" alt="Generic placeholder image" height="64">
                            <div class="media-body">
                                <h4 class="mt-0 mb-2 font-16">Airbnb Inc.</h4>
                                <p class="mb-1"><b>Location:</b> San Francisco, California</p>
                                <p class="mb-0"><b>Category:</b> Real Estate</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email mr-1"></i> austin@dayrep.com</p>
                        <p class="mb-0"><i class="mdi mdi-phone-classic mr-1"></i> (02) 75 150 655</p>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center mt-3 mt-sm-0">
                            <div class="badge font-14 bg-soft-danger text-danger p-1">Lost</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-sm-right">
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end card-box-->

            <div class="card-box mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="media">
                            <img class="d-flex align-self-center mr-3 rounded-circle" src="assets/images/companies/cisco.png" alt="Generic placeholder image" height="64">
                            <div class="media-body">
                                <h4 class="mt-0 mb-2 font-16">Cisco Systems</h4>
                                <p class="mb-1"><b>Location:</b> San Jose, California</p>
                                <p class="mb-0"><b>Category:</b> Operating Systems</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email mr-1"></i> annette@email.net</p>
                        <p class="mb-0"><i class="mdi mdi-phone-classic mr-1"></i> (+15) 73 483 758</p>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center mt-3 mt-sm-0">
                            <div class="badge font-14 bg-soft-success text-success p-1">Won</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-sm-right">
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end card-box-->

            <div class="text-center my-4">
                <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading mr-1"></i> Load more </a>
            </div>

        </div> <!-- end col -->

        <div class="col-xl-4 order-xl-2 order-1">
            <div class="card-box">
                <div class="media mb-3">
                    <img class="d-flex mr-3 rounded-circle avatar-lg" src="assets/images/users/user-8.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h4 class="mt-0 mb-1">Jade M. Walker</h4>
                        <p class="text-muted">Branch manager</p>
                        <p class="text-muted"><i class="mdi mdi-office-building"></i> Vine Corporation</p>

                        <a href="javascript: void(0);" class="btn- btn-xs btn-info">Send Email</a>
                        <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Call</a>
                        <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Edit</a>
                    </div>
                </div>

                <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Information</h5>
                <div class="">
                    <h4 class="font-13 text-muted text-uppercase">About Me :</h4>
                    <p class="mb-3">
                        Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type.
                    </p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Date of Birth :</h4>
                    <p class="mb-3"> March 23, 1984 (34 Years)</p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Company :</h4>
                    <p class="mb-3">Vine Corporation</p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Added :</h4>
                    <p class="mb-3"> April 22, 2016</p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Updated :</h4>
                    <p class="mb-0"> Dec 13, 2017</p>

                </div>

            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>

    @endsection
@section('script')
    <script src="{{asset('js/Movimiento/ventas.js')}}"></script>
    <script>
        var url = '{{url('Ventas')}}'
    </script>

    @endsection


