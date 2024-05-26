<?php
include '../include/header.php';
include '../include/sidebar.php';
include '../include/nav.php';
?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text mt-4">
                    <h4>List Of Tanks</h4>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-block table-border-style p-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>level_quantity</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

<?php
include '../include/footer.php';
?>
<!-- Include necessary scripts -->
<script src='../../js/jquery-3.3.1.min.js'></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom CSS for alert -->
<style>
    .fixed-top-alert {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1050;
        display: none;
    }
</style>

<!-- Alert container and audio element -->
<div id="alert-container" class="fixed-top-alert"></div>
<audio id="alert-sound" src="../uploads/reminder.mpeg" preload="auto"></audio>

<script>
    // Function to read and display table data
    const readTableData = () => {
        $.ajax({
            method: "POST",
            dataType: "JSON",
            data: { "action": "readLevel" },
            url: "../api/level_tracking.php",
            success: (res) => {
                let tr = "";
                const { data } = res;
                data.forEach(value => {
                    tr += `<tr>`;
                    tr += `<td>${value.id}</td>`;
                    tr += `<td>${value.level_quantity}</td>`;
                    tr += `</tr>`;
                });
                $(".table tbody").html(tr);
                $(".table").DataTable();
                console.log("Table data updated at", new Date());
            },
            error: (res) => {
                console.log("There is an error", res);
            },
        });
    };

    // Variable to track if the critical alert is currently displayed
    let criticalAlertVisible = false;

    // Function to check tank level and display alerts
    const checkTankLevel = () => {
        $.ajax({
            method: "POST",
            dataType: "JSON",
            data: { "action": "readLevel" },
            url: "../api/level_tracking.php",
            success: (res) => {
                const { data } = res;
                let showCriticalAlert = false;
                data.forEach(value => {
                    if (value.level_quantity <= 1000) {
                        showCriticalAlert = true;
                        if (!criticalAlertVisible) {
                            $('#alert-sound')[0].play();
                            $('#alert-container').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Critical Warning!</strong> The tank level is critically low (${value.level_quantity}). Please refill the tank.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `).show();
                            criticalAlertVisible = true;
                            $('#alert-container .close').on('click', () => {
                                criticalAlertVisible = false;
                            });
                        }
                    } else if (value.level_quantity <= 2000) {
                        toastr.info(`The tank level is getting low (${value.level_quantity}). Consider refilling soon.`);
                    }
                });
                if (!showCriticalAlert && criticalAlertVisible) {
                    $('#alert-container').hide();
                    criticalAlertVisible = false;
                }
                console.log("Tank level checked at", new Date());
            },
            error: (res) => {
                console.log("There is an error", res);
            },
        });
    };

    // Initial call to readTableData and checkTankLevel
    readTableData();
    checkTankLevel();

    // Set intervals to periodically update table data and check tank levels
    // setInterval(readTableData, 60000); // Update table every 1 minute
    setInterval(checkTankLevel, 15000); // Check tank levels every 15 seconds
</script>
</body>
</html>
