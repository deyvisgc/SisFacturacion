@extends('partials.layout')
@section('contenido')
    <style>
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Escritorio</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administracion</a></li>
                                <li class="breadcrumb-item active">Usuario</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Bandeja de Usuarios</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-7">
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="inputPassword2" class="sr-only">Search</label>
                                            <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="status-select" class="mr-2">Status</label>
                                            <select class="custom-select" id="status-select">
                                                <option selected="">Choose...</option>
                                                <option value="1">Paid</option>
                                                <option value="2">Awaiting Authorization</option>
                                                <option value="3">Payment failed</option>
                                                <option value="4">Cash On Delivery</option>
                                                <option value="5">Fulfilled</option>
                                                <option value="6">Unfulfilled</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-5">
                                    <div class="text-lg-right">
                                        <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Buscar Por Fechas</button>
                                        <button type="button" data-toggle="modal" data-target="#modalUsuario" class="btn btn-outline-success waves-effect mb-2"><i class="mdi mdi-plus mr-1"></i> Nuevo Usuario</button>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Order ID</th>
                                        <th>Products</th>
                                        <th>Date</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Order Status</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9708</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-1.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-2.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>
                                            August 05 2018 <small class="text-muted">10:29 PM</small>
                                        </td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $176.41
                                        </td>
                                        <td>
                                            Mastercard
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9707</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-3.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-4.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-5.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>August 04 2018 <small class="text-muted">08:18 AM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-warning text-warning"><i class="mdi mdi-timer-sand"></i> Awaiting Authorization</span></h5>
                                        </td>
                                        <td>
                                            $1,458.65
                                        </td>
                                        <td>
                                            Visa
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-warning">Processing</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9706</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-7.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>August 04 2018 <small class="text-muted">10:29 PM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $801.99
                                        </td>
                                        <td>
                                            Credit Card
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-warning">Processing</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                <label class="custom-control-label" for="customCheck5">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9705</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-3.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-8.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>August 03 2018 <small class="text-muted">07:56 AM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $215.35
                                        </td>
                                        <td>
                                            Mastercard
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-success">Delivered</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                <label class="custom-control-label" for="customCheck6">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9704</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-5.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-7.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>May 22 2018 <small class="text-muted">07:22 PM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-danger text-danger"><i class="mdi mdi-cancel"></i> Payment Failed</span></h5>
                                        </td>
                                        <td>
                                            $2,514.36
                                        </td>
                                        <td>
                                            Paypal
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-danger">Cancelled</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                <label class="custom-control-label" for="customCheck7">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9703</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-2.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>April 02 2018 <small class="text-muted">03:02 AM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $183.20
                                        </td>
                                        <td>
                                            Payoneer
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                <label class="custom-control-label" for="customCheck8">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9702</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-4.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-6.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>March 18 2018 <small class="text-muted">11:19 PM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-warning text-warning"><i class="mdi mdi-timer-sand"></i> Awaiting Authorization</span></h5>
                                        </td>
                                        <td>
                                            $1,768.41
                                        </td>
                                        <td>
                                            Visa
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-warning">Processing</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck9">
                                                <label class="custom-control-label" for="customCheck9">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9701</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-6.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-8.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-3.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>February 01 2018 <small class="text-muted">07:22 AM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-info text-info"><i class="mdi mdi-cash"></i> Cash on Delivery</span></h5>
                                        </td>
                                        <td>
                                            $3,582.99
                                        </td>
                                        <td>
                                            Paypal
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck10">
                                                <label class="custom-control-label" for="customCheck10">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9700</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-2.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-5.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>January 22 2018 <small class="text-muted">08:09 PM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $923.95
                                        </td>
                                        <td>
                                            Credit Card
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-success">Delivered</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                <label class="custom-control-label" for="customCheck11">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">#UB9699</a> </td>
                                        <td>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-7.jpg" alt="product-img" height="32"></a>
                                            <a href="ecommerce-prduct-detail.html"><img src="assets/images/products/product-8.jpg" alt="product-img" height="32"></a>
                                        </td>
                                        <td>January 17 2018 <small class="text-muted">02:30 PM</small></td>
                                        <td>
                                            <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                        </td>
                                        <td>
                                            $5,177.68
                                        </td>
                                        <td>
                                            Mastercard
                                        </td>
                                        <td>
                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <ul class="pagination pagination-rounded justify-content-end my-2">
                                <li class="page-item">
                                    <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div>
    @include('admin.Administracion.modal')
@endsection
@section('script')
    <script src="{{asset('js/administracion/usuarios.js')}}"></script>
@endsection


