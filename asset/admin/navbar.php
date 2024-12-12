<link rel="stylesheet" href="../css/style.css?v=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Sidebar -->
        <div class="card">
        <div class="card-content">
            <center><a href="javascript:void(0);" class="icon" id="menu-toggle1">
            <i class="fa fa-bars"></i>
            </a></center>
        </div>
        
        </div>

<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#" >
                        Dashboard Admin 
                    </a>
                </li>
                <li>
                    <a href="admin_dashboard.php">Home</a>
                </li>
                <li>
                    <a href="../../admin_logout.php">Logout</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
</div>
    <!-- /#wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });

    $(document).ready(function() {
        $("#menu-toggle1").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
</script>
