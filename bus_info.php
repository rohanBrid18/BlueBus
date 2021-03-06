<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 

                    if(isset($_GET['bus_id'])) {
                        $selected_bus = $_GET['bus_id'];
                    }

                    $query = "SELECT *  FROM  posts WHERE post_id = $selected_bus ";

                    $select_all_bus_query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_all_bus_query)) {
                        $bus_title = $row['post_title'];
                        $bus_author = $row['post_author'];
                        $bus_date = $row['post_date'];
                        $bus_image = $row['post_image'];
                        $bus_content = $row['post_content'];
                        $bus_id = $row['post_id'];
                        $bus_via = $row['post_via'];
                        $times = $row['post_via_time'];
                        $bus_cat = $row['post_category_id'];
                        $available_seats = $row['max_seats'];
                        $max_seats = $row['max_seats'];
                        $bus_stations = explode(" ",$bus_via);
                        $bus_times = explode(" ",$times);
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="bus_info.php?bus_id=<?php echo $selected_bus; ?>"><?php echo $bus_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $bus_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $bus_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $bus_image; ?>" alt="">

                        <hr>
                        <p><?php echo $bus_content ?></p>
                        
                        <div class="jumbotron jumb">
                            <h3>Max Seats:         <?php echo $max_seats ?></h3>

                            <h2><b>Stations Covered:</b></h2>
                            <table class="table table-striped" style="width: 100%; margin-top:-20px;">
                              <thead>
                                  <th><u>Station</u></th>
                                  <th><u>Time</u> </th>
                              </thead>
                              <tbody>
                                <?php

                                    for ($i=0; $i < sizeof($bus_stations); $i++) { ?>
                                        <tr>
                                          <td><?php echo $bus_stations[$i]; ?></td>
                                          <td><?php echo $bus_times[$i]; ?></td>
                                        </tr> <?php 
                                    }

                                ?>
                                <br>
                              </tbody>
                            </table>
                        </div>

                        <?php
                            $form1_vis = "hidden";
                            $form2_vis = "hidden";
                            $form3_vis = "hidden";
                        ?>

                        <div class="jumbotron">
                            <div class="container-fluid">
                                
                                <?php 
                                    if (!isset($_POST['doj']) and !isset($_GET['doj'])) {
                                        $form1_vis = "visible";
                                    }
                                ?>

                                <h2>Enter Details:</h2>

                                <form id="form1" action="" method="post" class="form-horizontal" style="visibility: <?php echo $form1_vis; ?>;">
                                    <input type="date" name="doj" style="margin-top: 10px; width: 40%" min=<?php echo date('Y-m-d');?> max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 29 days'));?> name="date" class="form-control" id="date" placeholder="dd/mm/yyyy" >
                                    <button class="btn-xs btn-primary" style="margin-left: 5px; margin-top: 5px">Check Availability</button>
                                </form>

                                <?php
                                    if (isset($_POST['doj'])) {
                                        $date = $_POST['doj'];

                                        $query_availability = "SELECT passenger_count FROM  orders WHERE bus_id = $selected_bus AND date = '$date' ";

                                        $result = mysqli_query($connection,$query_availability);

                                        while($row = mysqli_fetch_assoc($result)) {
                                            $pass_count = $row['passenger_count'];
                                            $available_seats = $available_seats - $pass_count;
                                        }
                                        
                                        $form1_vis = "hidden";
                                        $form2_vis = "visible";
                                    }
                                    else {
                                        $date = date($timestamp = 'time()');
                                    }
                                ?>

                                <form id="form2" action="bus_info.php?bus_id=<?php echo $selected_bus ?>&doj=<?php echo $date; ?>" method="post" class="form-horizontal" style="visibility: <?php echo $form2_vis; ?>;">

                                    <h3>Available Seats:   <?php echo $available_seats ?></h3>

                                    <select name="passenger_count" style="margin-bottom: 15px;margin-top: 15px;">
                                        <option value="0">Ticket Count</option>
                                        <?php
                                            if (isset($_GET['doj'])) {
                                                $date = $_GET['doj'];
                                            }
                                            for ($i=1; $i <= $available_seats; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option> <?php
                                            }

                                        ?>
                                    </select>
                                    <button class="btn-xs btn-primary" style="margin-left: 5px;" onclick="login_status()">GO</button>

                                </form>

                                <?php
                                    if (isset($_POST['passenger_count'])) {
                                        $passenger_count = $_POST['passenger_count'];

                                        $form1_vis = "hidden";
                                        $form2_vis = "hidden";
                                        $form3_vis = "visible";
                                    }
                                    else {
                                        $passenger_count = 0;
                                    }
                                ?>

                                <form id="form3" action="bus_info.php?bus_id=<?php echo $selected_bus ?>&doj=<?php echo $date; ?>&count=<?php echo $passenger_count ?>" method="post" class="form-horizontal" style="visibility: <?php echo $form3_vis; ?>;">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Source:</label>
                                        <div class="col-sm-10">
                                            <!-- <input type="text" class="form-control" id="email" placeholder="Source" name="source"> -->
                                            <select class="custom-select" id="inputGroupSelect01" name="source">
                                                <option selected>Enter Source</option>
                                                <?php 
                                                    for ($i=0; $i < sizeof($bus_stations); $i++) { ?>
                                                        <option value=<?php echo $bus_stations[$i]; ?>><?php echo $bus_stations[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Destination:</label>
                                        <div class="col-sm-10">
                                            <!-- <input type="text" class="form-control" id="email" placeholder="Destination" name="destination"> -->
                                            <select class="custom-select" id="inputGroupSelect01" name="destination">
                                                <option selected>Enter Destination</option>
                                                <?php 
                                                    for ($i=0; $i < sizeof($bus_stations); $i++) { ?>
                                                        <option value=<?php echo $bus_stations[$i]; ?>><?php echo $bus_stations[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                <?php

                                if (isset($_POST['passenger_count'])) {
                                    $count = $_POST['passenger_count'];
                                    //echo "<h1>$count</h1>";

                                    for ($i=0; $i < $count; $i++) { 

                                        ?>
                                        <h6><?php echo "Passenger "; echo $i+1;?></h6>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Name:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" placeholder="Name" name="name<?php echo "$i" ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Age:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" placeholder="Age" name="age<?php echo "$i" ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }

                                }

                                ?>

                                <button class="btn btn-primary" name="book" style="margin-left: 40%; margin-top: 15px;">Book Tickets</button>

                                </form>

                                <?php

                                if (isset($_POST['book'])) {
                                    //echo "<h1>hello</h1>";
                                    if (isset($_GET['count'])) {
                                        $count = $_GET['count'];
                                    }
                                    $source = $_POST['source'];
                                    $destination = $_POST['destination'];
                                    $date = $_GET['doj'];
                                    $cost = 0;


                                    // for ($i=0; $i < sizeof($bus_stations); $i++) { 

                                    //     if($bus_stations[$i]==$source) {
                                    //         //echo $bus_stations[$i];
                                    //         for ($j=$i; $j < sizeof($bus_stations); $j++) { 
                                    //             //echo $bus_stations[$j];
                                    //             $k=$j+1;
                                    //             $begin = $bus_stations[$j];
                                    //             $inter = $bus_stations[$k];
                                                $query_new = "SELECT * FROM cost WHERE start='$source' AND stopage='$destination' AND category=$bus_cat ";

                                                $get_cost = mysqli_query($connection,$query_new);
                                                while($row = mysqli_fetch_assoc($get_cost)) {
                                                      $cost = $row['cost'];
                                                    //   echo $station_cost;
                                                    //   $cost += $station_cost;
                                                   }
                                                   

                                    //                if($bus_stations[$k]==$destination)
                                    //                 break;
                                    //         }
                                    //         break;
                                    //     }
                                    // }
                                    //echo $cost;
                                    
                                    $total_cost = $cost * $count;

                                    // $query = "INSERT INTO orders(bus_id,user_id,user_name,user_age,source,destination,date) VALUES($selected_bus, $_SESSION['s_username'],$source,$destination,now())";

                                    $arr = array();
                                    $arr1 = array();
                                    for ($i=0; $i < $count; $i++) {
                                        //echo "<h1>hello</h1>";
                                        $name_query = 'name'.$i ;
                                        $age_query = 'age'.$i ;
                                        //echo $what;
                                        array_push($arr,$_POST[$name_query]);
                                        array_push($arr1,$_POST[$age_query]);
                                    }
                                    // for ($i=0; $i < $count; $i++) { 

                                        // $curr_name = $arr[$i];
                                        // $curr_age = $arr1[$i];
                                        $user_id = $_SESSION['s_id'];

                                        $query = "INSERT INTO orders(bus_id, user_id, passenger_count, source, destination, date, cost) VALUES($selected_bus, $user_id, $count, '$source', '$destination', '$date', $total_cost)";

                                        // $query_seat_update = "UPDATE posts SET available_seats = $available_seats + $count WHERE post_id = $bus_id";

                                        // //echo $arr[$i];
                                        // //echo $_SESSION['s_id'];
                                        // $update_seats_available = mysqli_query($connection,$query_seat_update);
                                        $booking_query = mysqli_query($connection,$query);
                                        if (!$booking_query) {
                                            die("Query Failed" . mysqli_error($connection));
                                        }
                                    // }
                                    header("Location: payment.php");
                                }

                                ?>
                            </div>
                        </div>

                        <hr>
                    <?php } ?>


                    <!-- Blog Comments -->

                <?php 

                    if (isset($_POST['submit_query'])) {
                        $user_name = ucfirst($_SESSION['s_username']) ;
                        if($user_name == "") {
                            $user_name = "(unknown)";
                        }
                        $user_email = $_POST['user_email'];
                        $user_query = $_POST['user_query'];

                        $query = "INSERT INTO query(query_bus_id, query_user, query_email, query_date, query_content, query_replied) VALUES ('$selected_bus', '$user_name', '$user_email', now(), '$user_query', 'no')";

                        $query_insert = mysqli_query($connection, $query);
                        if(!$query_insert) {
                            die("Query Failed" . mysqli_error($connection));
                        }

                        $query = "UPDATE posts SET post_query_count = post_query_count + 1 WHERE post_id = $bus_id";
                        $increase_query_count = mysqli_query($connection,$query);
                    }

                ?>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="bus_info.php?bus_id=<?php echo $selected_bus ?>" method="post" role="form">
                        
                        <!-- <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="user_name"></textarea>
                        </div> -->

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="user_email"></textarea>
                        </div>

                        <div class="form-group">
                            <label> Query</label>
                            <textarea class="form-control" rows="3" name="user_query"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_query">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                $query = "SELECT * FROM query WHERE query_bus_id = $bus_id";
                $get_query = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($get_query)) {
                    
                $query_user = $row['query_user'];
                $query_content = $row['query_content'];
                $query_date = $row['query_date'];

                ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $query_user; ?>
                            <small><?php echo $query_date; ?></small>
                        </h4>
                        <?php echo $query_content; ?>
                    </div>
                </div>
      
                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <script>
            function login_status(){
                <?php
                    if (! isset($_SESSION['s_id'])) { ?>
                        alert("Please login to continue.");
                        window.location= "index.php";
                <?php } ?>
            }
        </script>

<?php include "includes/footer.php"; ?>