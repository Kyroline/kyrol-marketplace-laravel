<div class="container-fluid position-sticky z-index-sticky top-0">
<!-- <div class="container position-sticky z-index-sticky top-0"> -->
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg rounded-lg rounded-bottom bg-primary">
            <!-- <nav class="navbar navbar-expand-lg border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 bg-primary "> -->
                <div class="container-fluid">
                    <div class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white">
                        <a href="{{ route('landing')    }}">Kyrol Marketplace</a>
                    </div>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item dropdown pe-2 px-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" data-boundary="window" aria-expanded="false">
                                    <i class="fa fa-bell cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                                    <!-- Notification starts here -->
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="./img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> from Laur
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        13 minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Notification ends here -->
                                </ul>
                            </li>
                            <li class="nav-item dropdown pe-2 px-3 d-flex align-items-center">
                                <a href="{{ route('user.shoppingcart') }}" class="nav-link text-white p-0" aria-expanded="false">
                                    <i class="fa fa-shopping-cart cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                                    <!-- Notification starts here -->
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="./img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> from Laur
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        13 minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Notification ends here -->
                                </ul>
                            </li>
                            <li class="nav-item dropdown pe-2 px-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" data-boundary="window" aria-expanded="false">
                                    <i class="fa fa-envelope cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                                    <!-- Notification starts here -->
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="./img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> from Laur
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        13 minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Notification ends here -->
                                </ul>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <a href="{{ route('user.profile') }}" class="nav-link text-white font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">User!</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-white font-weight-bold px-0">
                                        <i class="fa fa-user me-sm-1"></i>
                                        <span class="d-sm-inline d-none">Log out</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>