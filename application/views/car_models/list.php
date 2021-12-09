<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAk CARD APPLICATION</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asstes/css/bootstrap.rtl.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>/asstes/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/asstes/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asstes/css/style.css">
</head>

<body>
    <div class="header" style="background-color:black;">
        <div class="container">
            <h3 class="heading">AJAK CAR APPLICATION</h3>
                </div>
                    </div>
                        <div class="container">
                            <div class="row" style="padding-top:4px;">
                                <div class="col-md-6">
                                    <h4>Car Models</h4>
                                        </div>
                                            <div class="col-md-6 text-righ" style="text-align:right">
                                                <a href="javascript:void(0);" onclick="showModal();" class="btn btn-primary">Creadit </a>
                                                </div>
                                            <div class="col-md-12" style="padding-top:4px;">
                                         <table class="table table-striped" id="carModelList">
                                        <tbody>
                                      <tr>
                                    <th>ID </th>
                                    <th>Name </th>
                                    <th>color</th>
                                    <th>Transmission </th>
                                    <th>Price </th>
                                    <th>Creadit Date </th>
                                    <th>Edit</th>
                                    <th>Delete </th>
                                    </tr>
                                <?php if (!empty($rows)) { ?>
                            <?php foreach ($rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['color'] ?></td>
                                    <td><?php echo $row['transmission'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick ="showEditForm(<?php echo $row['id'] ?>);" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td>Records not found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createCar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div id="response">
                </div>
                <form action="" method="post" id="createCarModel" name="createCarModel">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Name">
                            <p class="nameError"></p>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" id="color" value="" class="form-control" placeholder="Color">
                            <p class="colorError"></p>
                        </div>
                        <div class="form-group">
                            <label>Transmission</label>
                            <select name="transmission" id="transmission" class="form-control">
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" id="Price" value="" class="form-control" placeholder="Price">
                            <p class="priceError"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ajaxResponseModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="model-body">
                </div>
                <div class="model-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="model">close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showModal() {

            $("#createCar").modal("show");
            $.ajax({
                url: '<?php echo base_url() . 'index.php/CarModel/showCreateFrom' ?>',
                type: 'POST',
                data: {},
                dataType: 'jsone',
                success: function(response) {
                    console.log(response);
                    $("#response").html(response["html"]);

                }
            })
        }
        $("body").on("submit", "#createCarModel", function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() . 'index.php/CarModel/saveModel' ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {



                    if (response['status'] == 0) {
                        if (response["name"] != "") {
                            $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                            $("name").addclass('is-invalid');
                        } else {
                            $(".nameError").html("").removeClass('invalid-feedback');
                            $("#name").removeClass('is-invalid');
                        }
                        if (response["color"] != "") {
                            $(".colorError").html(response["color"]).addClass('invalid-feedback d-block');
                            $("color").addclass('is-invalid');
                        } else {
                            $(".colorError").html("").removeClass('invalid-feedback');
                            $("#color").removeClass('is-invalid');
                        }
                        if (response["price"] != "") {
                            $(".priceError").html(response["price"]).addClass('invalid-feedback d-block');
                            $("price").addclass('is-invalid');
                        } else {
                            $(".priceError").html("").removeClass('invalid-feedback');
                            $("#price").removeClass('is-invalid');
                        }

                    } else {
                        $("#createCar").modal("hide");
                        $("#ajaxResponseModal .model-body").html(response["message"]);
                        $("#ajaxResponseModal").modal("show");

                        $(".nameError").html("").removeClass('invalid-feedback');
                        $("#name").removeClass('is-invalid');

                        $(".colorError").html("").removeClass('invalid-feedback');
                        $("#color").removeClass('is-invalid');

                        $(".priceError").html("").removeClass('invalid-feedback');
                        $("#price").removeClass('is-invalid');

                        $("#carModelList").append(response["row"]);
                    }

                }
            });
        });
        function showEditForm(id){
            alert(id);
        }
    </script>
</body>

</html>