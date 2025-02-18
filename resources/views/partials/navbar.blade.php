<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid d-flex  align-items-center">
        <a class="navbar-brand fw-bolder ms-3" href="#" style="font-family: Poppins, Montserrat, sans-serif;"> 
            <i class="bi bi-stars text-warning"></i>
            Todo List App
        </a>        
        <div class="d-flex align-items-center justify-content-center gap-2 me-3">

             {{-- FORM PENCARIAN --}}
         <div class="col-auto">
            <form action="{{ route('home') }}" method="GET" class="d-flex gap-3">
                <input type="text" class="form-control" name="query" placeholder="Cari tugas atau list..."
                    value="{{ request()->query('query') }}">
                <button type="submit" class="btn btn-outline-white text-white">Cari</button>
            </form>
        </div>
        
        <!-- Tombol Notification -->
        <div class="position-relative me-3">
            <button id="notificationIcon" class="btn btn-outline-light position-relative">
                <i class="bi bi-bell-fill"></i>
                <span id="notificationCount" class="Badge bg-danger position-absolute top-0 start-100 translate-middle"></span>
            </button>
            <div id="notificationDropdown" class="notification-dropdown">
                <ul id="notificationList" class="list-unstyled m-0 p-2"></ul>
            </div>
        </div>

            <!-- Tombol Tema -->
            <button id="theme-switch"  class="btn btn-outline-light">
                <i class="bi bi-moon-fill" alt="dark-mode"></i>           
                <i class="bi bi-sun-fill text-white"></i>
            </button>

                <!-- Profil & Nama -->
        <div class="d-flex align-items-center">
            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#profileModal"> 
                <img src="{{ asset('img/img-3.JPG') }}" alt="Profil Kurniawan" class="rounded-circle" width="35" height="35">
                <span class="ms-2 fw-bold text-white" style="font-family: Poppins, Montserrat, sans-serif;">
                    Kurniawan
                </span>
            </a>               
        </div>          
        </div>
    </div>
</nav>



