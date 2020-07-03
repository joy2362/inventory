<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Starlight Responsive Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- vendor css -->
    <link href="{{asset('back/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('back/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('back/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('back/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('back/css/starlight.css')}}">

</head>

<body>
<div id="app">
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo" id="toplogoPanel" style="display: none" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
    <div class="sl-sideleft" id="leftsidetPanel" style="display: none" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true">

        <div class="sl-sideleft-menu">
            <router-link to="/home" class="sl-menu-link active">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label">Dashboard</span>
                </div><!-- menu-item -->
            </router-link><!-- sl-menu-link -->

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-people-outline tx-20"></i>
                    <span class="menu-item-label">Employee</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><router-link to="/add/employee" class="nav-link">Add Employee</router-link></li>
                <li class="nav-item"><router-link to="/all/employee" class="nav-link">All Employee</router-link></li>
            </ul>
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Supplier</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><router-link to="/add/supplier" class="nav-link">Add Supplier</router-link></li>
                <li class="nav-item"><router-link to="/all/supplier" class="nav-link">All Supplier</router-link></li>
            </ul>
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                    <span class="menu-item-label">Category</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><router-link to="/add/category" class="nav-link">Add Category</router-link></li>
                <li class="nav-item"><router-link to="/all/category" class="nav-link">All Category</router-link></li>
            </ul>
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                    <span class="menu-item-label">Product</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><router-link to="/add/product" class="nav-link">Add Product</router-link></li>
                <li class="nav-item"><router-link to="/all/product" class="nav-link">All Product</router-link></li>
            </ul>
        </div><!-- sl-sideleft-menu -->

        <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header" id="toptPanel" style="display: none" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true">
        <div class="sl-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        </div><!-- sl-header-left -->
        <div class="sl-header-right">
            <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name" id="UserName"></span>
                        <img src="{{asset('back/img/img3.jpg')}}" class="wd-32 rounded-circle" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-200">
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                            <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
                            <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>
                            <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>
                            <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li>
                            <li><router-link to="/logout"><i class="icon ion-power"></i> Sign Out</router-link></li>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>
            <div class="navicon-right">
                <a id="btnRightMenu" href="" class="pos-relative">
                    <i class="icon ion-ios-bell-outline"></i>
                    <!-- start: if statement -->
                    <span class="square-8 bg-danger"></span>
                    <!-- end: if statement -->
                </a>
            </div><!-- navicon-right -->
        </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright" >
        <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
            </li>
        </ul><!-- sidebar-tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
                <div class="media-list">
                    <!-- loop starts here -->
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                                <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                                <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                    </a>
                    <!-- loop ends here -->
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{asset('back/img/img4.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Samantha Francis</p>
                                <span class="d-block tx-11 tx-gray-500">3 hours ago</span>
                                <p class="tx-13 mg-t-10 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{asset('back/img/img7.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Robert Walker</p>
                                <span class="d-block tx-11 tx-gray-500">5 hours ago</span>
                                <p class="tx-13 mg-t-10 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Larry Smith</p>
                                <span class="d-block tx-11 tx-gray-500">Yesterday, 8:34pm</span>

                                <p class="tx-13 mg-t-10 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                                <span class="d-block tx-11 tx-gray-500">Jan 23, 2:32am</span>
                                <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                    </a>
                </div><!-- media-list -->
                <div class="pd-15">
                    <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
                </div>
            </div><!-- #messages -->

            <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
                <div class="media-list">
                    <!-- loop starts here -->
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                                <span class="tx-12">October 03, 2017 8:45am</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <!-- loop ends here -->
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                                <span class="tx-12">October 02, 2017 12:44am</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                                <span class="tx-12">October 01, 2017 10:20pm</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                                <span class="tx-12">October 01, 2017 6:08pm</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 12 others in a post.</p>
                                <span class="tx-12">September 27, 2017 6:45am</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700">10+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                                <span class="tx-12">September 28, 2017 11:30pm</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Great Pyramid</strong></p>
                                <span class="tx-12">September 26, 2017 11:01am</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{asset('back/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                                <span class="tx-12">September 23, 2017 9:19pm</span>
                            </div>
                        </div><!-- media -->
                    </a>
                </div><!-- media-list -->
            </div><!-- #notifications -->

        </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->
    <div class="sl-mainpanel" id="sl-mainpanel" style="display: none" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true">
        <div class="sl-pagebody">
            <router-view></router-view>
        </div>
    </div><!-- sl-mainpanel -->
    <div id="formShow" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? true : false">
        <router-view></router-view>
    </div>
</div>
<script src="{{asset('js/app.js')}}" ></script>
<script src="{{asset('back/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('back/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('back/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('back/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('back/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('back/lib/d3/d3.js')}}"></script>
<script src="{{asset('back/lib/chart.js/Chart.js')}}"></script>
<script src="{{asset('back/lib/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('back/lib/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('back/lib/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('back/lib/flot-spline/jquery.flot.spline.js')}}"></script>

<script src="{{asset('back/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('back/lib/datatables-responsive/dataTables.responsive.js')}}"></script>

<script src="{{asset('back/js/starlight.js')}}"></script>
<script src="{{asset('back/js/ResizeSensor.js')}}"></script>
<script src="{{asset('back/js/dashboard.js')}}"></script>

<script src="{{asset('back/lib/select2/js/select2.min.js')}}"></script>
<script src="{{asset('back/lib/highlightjs/highlight.pack.js')}}"></script>

<script>
    let token = localStorage.getItem('token');
    let user = localStorage.getItem('user');
    if(token){
        $("#toplogoPanel").css("display","");
        $("#toptPanel").css("display","");
        $("#leftsidetPanel").css("display","");
        $("#sl-mainpanel").css("display","");
        $("#formShow").css("display","none");
        $("#UserName").html(user);
    }

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>

</body>
</html>
