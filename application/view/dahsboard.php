<?php
include '../include/header.php';
include '../include/sidebar.php';
include '../include/nav.php';
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Smart-Milk</strong> Dashboard</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
                <a href="#" class="btn btn-primary">New Project</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Users</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3 users"></h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 3.65%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Orders</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">2.542</h1>
                        <div class="mb-0">
                            <span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right"></i> -5.25%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Activity</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="activity"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">16.300</h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 4.65%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Revenue</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">$20.120</h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 2.35%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="piechart" style="width: 900px; height: 500px;"></div>
            <!-- <div id="columnchart_values" style="width: 900px; height: 300px;"></div> -->
            <!-- <div id="top_x_div" style="width: 900px; height: 500px;"></div>  -->
        </div>

    </div>
</main>

<?php
include '../include/footer.php'
    ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        const countRowNumbers = (tableName, label) => {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                url: "../api/admin.php",
                data: {
                    action: "count",
                    table: tableName,
                },
                success: (res) => {
                    console.log(res)
                    label.html(res.rowNumber);
                },
                error: (res) => {
                    console.log(res)
                    // displayToast("Internal Server Error Ocurred 🤷‍♂😢️", "error", 2000);
                }
            })
        }
        countRowNumbers("users", $(".users"))

    //     function count() {
    //         $.ajax({
    //             method: "POST",
    //             dataType: "JSON",
    //             data: {
    //                 action: "count",
    //             },
    //             url: "../api/admin.php",
    //             success: (res) => {
    //                 console.log(res.data);
    //                 google.charts.load('current', { 'packages': ['corechart'] });
    //                 google.charts.setOnLoadCallback(() => drawChart(res.data)); // Pass the response data to drawChart
    //             },
    //             error: (err) => {
    //                 console.log(err);
    //             },
    //         });
    //     }

    //     function drawChart(data) {
    //         // Convert the received data to a format suitable for Google Charts
    //         var chartData = [['Most', 'Requestedcompany']];
    //         data.forEach(item => {
    //             chartData.push([item.ind_name, parseInt(item.request_count)]);
    //         });

    //         // Create a DataTable from the data
    //         var dataTable = google.visualization.arrayToDataTable(chartData);

    //         var options = {
    //             title: 'Companies Request Count'
    //         };

    //         var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    //         chart.draw(dataTable, options);
    //     }
    //     count()
    //         ;

    //     google.charts.load("current", { packages: ['corechart'] });
    //     google.charts.setOnLoadCallback(drawChart);
    //     function drawChart() {
    //         var data = google.visualization.arrayToDataTable([
    //             ["Element", "Density", { role: "style" }],
    //             ["Copper", 8.94, "blue"],
    //             ["Silver", 10.49, "blue"],
    //             ["Gold", 19.30, "blue"],
    //             ["Platinum", 21.45, "color: blue"]
    //         ]);

    //         var view = new google.visualization.DataView(data);
    //         view.setColumns([0, 1,
    //             {
    //                 calc: "stringify",
    //                 sourceColumn: 1,
    //                 type: "string",
    //                 role: "annotation"
    //             },
    //             2]);

    //         var options = {
    //             title: "Density of Precious Metals, in g/cm^3",
    //             width: 600,
    //             height: 400,
    //             bar: { groupWidth: "95%" },
    //             legend: { position: "none" },
    //         };
    //         var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    //         chart.draw(view, options);
    //     }
    // });
    // $(".login").click((e) => {

    });
</script>