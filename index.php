<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ktenant Homepage</title>
    <link rel="stylesheet" type="text/css" href="files/bootstrap/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="node_modules/bootstrap4-modal-fullscreen/dist/bootstrap4-modal-fullscreen.min.css" rel="stylesheet">
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Real Estate Management System</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <?php 
     include 'database2.php'; 
     include 'navbar.php';
        ?>

    <!-- Navbar -->


    <div class="overlay-black w-100 slider-banner1 position-relative" style="background-image: url('home.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <div class="text-white">
                        <h1 class="mb-4"><span class="text-success">Let us</span><br>
                            Guide you Home</h1>
                        <form method="post" action="propertygrid.php">
                            <div class="row">
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <select class="form-control" name="type">
                                            <option value="">Select Type</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="flat">Flat</option>
                                            <option value="building">Building</option>
                                            <option value="house">House</option>
                                            <option value="villa">Villa</option>
                                            <option value="office">Office</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <select class="form-control" name="stype">
                                            <option value="">Select Status</option>
                                            <option value="rent">Rent</option>
                                            <option value="sale">Sale</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="city" placeholder="Enter City"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <button type="submit" name="filter" class="btn btn-dark w-100">Search
                                            Property</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Listings -->

    <div class="col-md-12">
        <div class="tab-content mt-4" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">
                <div class="row">

                    <?php
                $result = mysqli_query($conn, "SELECT * FROM property");
                if (mysqli_num_rows($result) > 0) {
                    $num = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $popup = "popup_" . $num;
                        $monthlyRateValue = $row['monthly_rate'];
                        $formattedMonthly = 'MWK ' . number_format((float)$monthlyRateValue, 2, '.', ',');
                ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="featured-thumb hover-zoomer mb-4">
                            <div class="overlay-black overflow-hidden position-relative">
                                <img src="<?php echo $row['property_image'] ? 'http://localhost/Tenant/system/landlord/photos/' . $row['property_image'] : 'http://localhost/Tenant/system/landlord/photos/default.png'; ?>"
                                    alt="Property Image" class="card-img-top">
                                <div class="featured bg-success text-white">New</div>
                                <div class="sale bg-dark text-white text-capitalize">For Rent</div>
                                <div class="price text-light"><b><?php echo $formattedMonthly; ?></b><span
                                        class="text-white"><?php echo $row['square_feet']; ?> Sqft</span></div>
                            </div>
                            <div class="featured-thumb-data shadow-one">
                                <div class="p-3">
                                    <h5 class="text-black hover-text-success mb-2 text-capitalize">
                                        <?php echo $row['property_name']; ?></a></h5>
                                    <span class="location text-capitalize">
                                        <span class="material-icons">
                                            pin_drop
                                        </span>
                                        <?php echo $row['street_address']; ?></span>
                                </div>
                                <div class="bg-gray quantity px-4 pt-4">
                                    <ul>
                                        <li><span><?php echo $row['square_feet']; ?></span> Sqft</li>
                                        <li><span><?php echo $row['rooms']; ?></span> Beds</li>
                                        <li><span><?php echo $row['baths']; ?></span> Baths</li>
                                        <li><span><?php echo $row['kitchen']; ?></span> Kitchen</li>
                                        <li><span><?php echo $row['balcony']; ?></span> Balcony</li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-dark btn-block"
                                                onclick="showPropertyDetails(<?php echo $row['property_id']; ?>)">View
                                                Details</button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                        <p id="propertyDetails"></p>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex">
                                                       
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $num++;
                    }
                } else {
                    echo "No result found";
                }
                ?>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function showPropertyDetails(propertyId) {
    // Perform AJAX request to fetch property details
    $.ajax({
        url: 'get_property_info.php', // Replace with your server-side script URL
        type: 'GET',
        data: {
            property_id: propertyId // Use the property ID passed as the parameter
        },
        success: function(response) {
            // Update the modal with the property details
            $('#propertyDetails').html(response);
            $('#exampleModal').modal('show');
            var tempElement;

            var tempElement = $('<div>').html(response);
            var monthlyRate = tempElement.find('#monthlyRateValue').val();
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
}
</script>