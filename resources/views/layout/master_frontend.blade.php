<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('admin/assets_frontend/material-kit-pro-master./assets/img/apple-icon.png')}}">
    <link rel="icon" href="{{asset('admin/assets_frontend/material-kit-pro-master./assets/img/favicon.png')}}">
    <title>
        Center Of Students Development 
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{asset('admin/assets_frontend/material-kit-pro-master/assets/css/material-kit.css?v=2.0.3')}}">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('admin/assets_frontend/material-kit-pro-master/assets/assets-for-demo/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets_frontend/material-kit-pro-master/assets/assets-for-demo/vertical-nav.css')}}" rel="stylesheet" />
</head>

@yield('content')
<nav class="navbar fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
        <div class="container-fluid">
            <div class="navbar-translate">
                <img src="{{asset('admin/assets/img/logokalbis.png')}}" style="max-width: 30%">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/" >
                            <i class="material-icons">apps</i> Home
                        </a>
                      &nbsp  &nbsp 
                <!--     <a href="/frontend/visimisi" >
                            <i class="material-icons">apps</i> Visi & Misi
                        </a> -->
                    </li>


                      <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">apps</i> Himpunan Mahasiswa
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                          
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">content_paste</i> HM
                            </a>
                           
                            @foreach(App\ormawa::all() as $ormawa)
                            @if($ormawa->kategori_ormawa == 'HMJ')
                                <a href="{{url('/ormawa/'.$ormawa->id)}}" class="dropdown-item">
                                    <i class="material-icons">how_to_reg</i> {{$ormawa->nama_ormawa}}
                                </a>
                            @endif
                            @endforeach
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">apps</i>  Unit Kegiatan Mahasiswa
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                          
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">content_paste</i> UKM
                            </a>
                           
                            @foreach(App\ormawa::all() as $ormawa)
                            @if($ormawa->kategori_ormawa == 'UKM')
                                <a href="{{url('/ormawa/'.$ormawa->id)}}" class="dropdown-item">
                                    <i class="material-icons">how_to_reg</i> {{$ormawa->nama_ormawa}}
                                </a>
                            @endif
                            @endforeach
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">apps</i> Unit Kegiatan Rohani
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                          
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">content_paste</i> UKR
                            </a>
                           
                            @foreach(App\ormawa::all() as $ormawa)
                            @if($ormawa->kategori_ormawa == 'UKR')
                                <a href="{{url('/ormawa/'.$ormawa->id)}}" class="dropdown-item">
                                    <i class="material-icons">how_to_reg</i> {{$ormawa->nama_ormawa}}
                                </a>
                            @endif
                            @endforeach
                        </div>
                    </li>


                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    @auth
                    <li class="button-container nav-item iframe-extern">
                        <a href="{{url('/dashboard/')}}">
                        Dashboard
                        </a>
                    </li>   
                    @else
                    <li class="button-container nav-item iframe-extern">
                        <a href="/skpi/login">
                        Login Kalbiser
                        </a>
                    </li>   
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
   

    <!--  End Modal -->
  <footer class="page-footer font-small blue pt-4" style="background-color: black;">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

          <!-- Grid row -->
          <div class="row">

            <!-- Grid column -->
            <div class="col-md-8 mt-md-0 mt-3">

              <!-- Content -->
              <img src="{{asset('logo/logoKalbis.png')}}" width="50%">
            <div class="container" style="margin-left: 100px;">
                
                    <div class="col-md-8;">
              <p class="" style="color: white; font-size: 29px;">
                <br>

                    Jl. Pulomas Selatan kav.22, Jakarta Timur 13210
                    <br>
                    <br>
                    Telp. (021) 4788-3900 &nbsp -1239
                    <br>
                    <br>
                    Fax. (021) 4788-3651
                    <br>
                    <br>
                    csd@kalbis.ac.id
                    <br>
                    <br>
                    Instagram : csd.kalbis
                </p>
                </div>
        
                </div>
                    
            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
              <div class="col-md-4 mb-md-0 mb-6">

                <!-- Links -->
                <br>
                <h2 class="text-uppercase" style="color: white">SOCIAL MEDIA</h2>
                <h4>
                    <a href="https://www.instagram.com/csd.kalbis/">
                  <button class="btn btn-light btn-circle btn-circle-sm m-1" style="width: 45px;height: 45px;line-height: 45px;text-align: center;padding: 0;border-radius: 50%"><i class="fa fa-instagram" style="color: black"></a></i></button>
                </h4>

              </div>

            </div>
            <!-- Grid column -->

          </div>
          <!-- Grid row -->

        </div>
        <!-- Footer Links -->

      </footer>
<!-- Footer -->
    <!--   Core JS Files   -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/bootstrap-material-design.js')}}"></script>
    <!--  Google Maps Plugin  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/moment.min.js')}}"></script>
    <!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/nouislider.min.js')}}"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
    <!--  Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
    <!--  Plugin for Small Gallery in Product Page -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/plugins/jquery.flexisel.js')}}"></script>
    <!-- Plugins for presentation and navigation  -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/assets-for-demo/js/modernizr.js')}}"></script>
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/assets-for-demo/js/vertical-nav.js')}}"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/js/material-kit.js?v=2.0.3')}}"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="{{asset('admin/assets_frontend/material-kit-pro-master/assets/assets-for-demo/js/material-kit-demo.js')}}"></script>
    <script>
        $(document).ready(function() {

            //init DateTimePickers
            materialKit.initFormExtendedDatetimepickers();

            // Sliders Init
            materialKit.initSliders();
        });
    </script>
    
</body>

</html>
