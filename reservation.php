
<?php include('partials-front/menu.php'); ?>

    <?php 
    
        if(isset($_GET['hotel_id']))
        {
            
            $hotel_id = $_GET['hotel_id'];

            $sql = "SELECT * FROM tbl_hotel WHERE id=$hotel_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
            
                //REdirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    
    <section class="hotel-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your booking.</h2>

            <form action="" method="POST" class="reservation">
                <fieldset>
                    <legend style="color: white">&nbsp Selected Hotel &nbsp</legend>

                    <div class="hotel-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/hotel/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div style="color: white" class="hotel-menu-desc">
                        <h3 ><?php echo $title; ?></h3>
                        <input type="hidden" name="hotel" value="<?php echo $title; ?>">

                        <p class="hotel-price">USD <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <div class="reservation-label">Starting Date</div>
                        <input type="date" id="startdate" onchange="cal()" min="<?php echo date('Y-m-d'); ?>" name="startdate" class="input-responsive" required>

                        <div class="reservation-label">End Date</div>
                        <input type="date" id="enddate" onchange="cal()" name="enddate" class="input-responsive" required>

                    

                    </div>

                </fieldset>
                
                <fieldset style="color: white">
                    <legend style="color: white">&nbsp Booking Details &nbsp</legend>
                    <div class="reservation-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Juan Dela Cruz" class="input-responsive" required>

                    <div class="reservation-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 09xxxxxxxxx" class="input-responsive" required>

                    <div class="reservation-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. juandelacruz@email.com" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $hotel = $_POST['hotel'];
                    $price = $_POST['price'];
                    
                    $total = $price;

                    $reservation_date = date("Y-m-d h:i:sa"); 

                    $status = "Booked";  

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $start_date = $_POST['startdate'];
                    $end_date = $_POST['enddate'];

                    
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_reservation SET 
                        hotel = '$hotel',
                        price = $price,
                        total = $total,
                        reservation_date = '$reservation_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        start_date = '$start_date',
                        end_date = '$end_date'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        
                       
                        //header('location:'.SITEURL);
                        echo '<script type="text/javascript">';
                        echo 'window.location.href="'.SITEURL.'index.php?reservation=success";';
                        echo '</script>';
                    }
                    else
                    {
                        
                        echo '<script type="text/javascript">';
                        echo 'window.location.href="'.SITEURL.'index.php?reservation=error";';
                        echo '</script>';
                    }

                }
            
            ?>

        </div>
    </section>
  

    <?php include('partials-front/footer.php'); ?>

