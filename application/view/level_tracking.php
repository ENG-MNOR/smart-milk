<?php
include '../include/header.php';
include '../include/sidebar.php';
include '../include/nav.php'
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
            <!-- <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin</a></li>
                </ol>
            </div> -->
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <button data-toggle="modal" data-target="#exampleModal"
                            class="btn btn-primary float-right add">Add New Admin</button>
                    </div>
                    <div class="card-block table-border-style p-3">
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>level_quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

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

<!-- <div class="modal fade adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->

<div class="modal fade tankModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Tank (Only Admin Based)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <!-- <label for="recipient-name" class="col-form-label">name:</label> -->
                        <input type="hidden" class="form-control id" placeholder="@username" 
                            required>
                    </div>
                <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">note:</label>
                        <input type="text" class="form-control note" placeholder="@username" 
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">quantity</label>
                        <input type="text" class="form-control quantity" placeholder="quantity" 
                            required>
                    </div>
                

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">save</button>
            </div>
        </div>
    </div>
</div>
<?php
include '../include/footer.php';
?>
<script src='../../js/jquery-3.3.1.min.js'></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="../iziToast-master/dist/js/iziToast.js"></script>
<script src="../iziToast-master/dist/js/iziToast.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(() => {

        const readLevel = () => {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                data: {
                    "action": "readLevel"
                },
                url: "../api/level_tracking.php",
                success: (res) => {
                    var tr = "<tr>"
                    var {
                        data
                    } = res;
                    data.forEach(value => {
                        tr += `<td>${value.id}</td>`
                        tr += `<td>${value.level_quantity}</td>`                         
                    })
                    $(".table tbody").html(tr);
                    $(".table").DataTable();

                    console.log("data is ", data)
                },
                error: (res) => {
                    console.log("There is an error")
                    console.log(res)
                },
            })
        }
        readLevel();
    })

 


</script>

