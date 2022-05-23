
    <?php include('partials-front/menu.php'); ?>

   
    <section class="hotel-search text-center">
        <div class="container">
            <?php 

                //Get the Search Keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2>Hotels on Your Search <a href="#">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    



    <section class="hotel-menu">
        <div class="container">
            <h2 class="text-center">Available Hotels</h2>

            <?php 

               
                $sql = "SELECT * FROM tbl_hotel WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

               
                if($count>0)
                {
              
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="hotel-menu-box">
                            <div class="hotel-menu-img">
                                <?php 
                                    // Check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/hotel/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php 

                                    }
                                ?>
                                
                            </div>

                            <div class="hotel-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="hotel-price">$ <?php echo $price; ?></p>
                                <p class="hotel-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
               
                    echo "<div class='error'>Hotel not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
 

    <?php include('partials-front/footer.php'); ?>