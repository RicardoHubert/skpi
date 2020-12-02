@extends('layout.master_frontend')

@section('content')	

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <title>
        Signup &#45; Material Kit by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.3">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
</head>

<body class="signup-page ">
    <nav class="navbar  navbar-transparent    navbar-absolute  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../index.html">Material Kit PRO </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">apps</i> Components
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../index.html" class="dropdown-item">
                                <i class="material-icons">layers</i> All Components
                            </a>
                            <a href="http://demos.creative-tim.com/material-kit-pro/docs/2.0/getting-started/introduction.html" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Documentation
                            </a>
                        </div>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">view_day</i> Sections
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../sections.html#headers" class="dropdown-item">
                                <i class="material-icons">dns</i> Headers
                            </a>
                            <a href="../sections.html#features" class="dropdown-item">
                                <i class="material-icons">build</i> Features
                            </a>
                            <a href="../sections.html#blogs" class="dropdown-item">
                                <i class="material-icons">list</i> Blogs
                            </a>
                            <a href="../sections.html#teams" class="dropdown-item">
                                <i class="material-icons">people</i> Teams
                            </a>
                            <a href="../sections.html#projects" class="dropdown-item">
                                <i class="material-icons">assignment</i> Projects
                            </a>
                            <a href="../sections.html#pricing" class="dropdown-item">
                                <i class="material-icons">monetization_on</i> Pricing
                            </a>
                            <a href="../sections.html#testimonials" class="dropdown-item">
                                <i class="material-icons">chat</i> Testimonials
                            </a>
                            <a href="../sections.html#contactus" class="dropdown-item">
                                <i class="material-icons">call</i> Contacts
                            </a>
                        </div>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">view_carousel</i> Examples
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../examples/about-us.html" class="dropdown-item">
                                <i class="material-icons">account_balance</i> About Us
                            </a>
                            <a href="../examples/blog-post.html" class="dropdown-item">
                                <i class="material-icons">art_track</i> Blog Post
                            </a>
                            <a href="../examples/blog-posts.html" class="dropdown-item">
                                <i class="material-icons">view_quilt</i> Blog Posts
                            </a>
                            <a href="../examples/contact-us.html" class="dropdown-item">
                                <i class="material-icons">location_on</i> Contact Us
                            </a>
                            <a href="../examples/landing-page.html" class="dropdown-item">
                                <i class="material-icons">view_day</i> Landing Page
                            </a>
                            <a href="../examples/login-page.html" class="dropdown-item">
                                <i class="material-icons">fingerprint</i> Login Page
                            </a>
                            <a href="../examples/pricing.html" class="dropdown-item">
                                <i class="material-icons">attach_money</i> Pricing Page
                            </a>
                            <a href="../examples/ecommerce.html" class="dropdown-item">
                                <i class="material-icons">store</i> Ecommerce Page
                            </a>
                            <a href="../examples/product-page.html" class="dropdown-item">
                                <i class="material-icons">shopping_cart</i> Product Page
                            </a>
                            <a href="../examples/profile-page.html" class="dropdown-item">
                                <i class="material-icons">account_circle</i> Profile Page
                            </a>
                            <a href="../examples/signup-page.html" class="dropdown-item">
                                <i class="material-icons">person_add</i> Signup Page
                            </a>
                        </div>
                    </li>
                    <li class="button-container nav-item iframe-extern">
                        <a href="http://www.creative-tim.com/buy/material-kit-pro?ref=presentation" target="_blank" class="btn  btn-primary   btn-round btn-block">
                            <i class="material-icons">shopping_cart</i> Buy Now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-header header-filter" filter-color="purple" style="background-image: url(&apos;../assets/img/bg7.jpg&apos;); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                    <div class="card card-signup">
                        <h2 class="card-title text-center">Register</h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-rose">
                                            <i class="material-icons">timeline</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Marketing</h4>
                                            <p class="description">
                                                We've created the marketing campaign of the website. It was a very interesting collaboration.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-primary">
                                            <i class="material-icons">code</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Fully Coded in HTML5</h4>
                                            <p class="description">
                                                We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-info">
                                            <i class="material-icons">group</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Built Audience</h4>
                                            <p class="description">
                                                There is also a Fully Customizable CMS Admin Dashboard for this product.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mr-auto">
                                    <div class="social text-center">
                                        <button class="btn btn-just-icon btn-round btn-twitter">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button class="btn btn-just-icon btn-round btn-dribbble">
                                            <i class="fa fa-dribbble"></i>
                                        </button>
                                        <button class="btn btn-just-icon btn-round btn-facebook">
                                            <i class="fa fa-facebook"> </i>
                                        </button>
                                        <h4> or be classical </h4>
                                    </div>
                                    <form class="form" method="" action="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">face</i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="First Name...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">mail</i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Email...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                </div>
                                                <input type="password" placeholder="Password..." class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                                I agree to the
                                                <a href="#something">terms and conditions</a>.
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <a href="#pablo" class="btn btn-primary btn-round">Get Started</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer ">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://presentation.creative-tim.com">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
                </div>
            </div>
        </footer>
    </div>

</body>

</html>