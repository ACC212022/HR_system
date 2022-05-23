    <?php include('partials-front/menu.php'); ?>

   
    <section class="hotel-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>hotel-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Hotels" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
   

    <?php 
       
        if(isset($_GET['reservation'])){
            $reservation = $_GET['reservation'];
            if ($reservation == "success") {
                echo "<div class='success text-center'>Hotel Reserved Successfully.</div>";
            } elseif ($reservation == "error") {
                echo "<div class='error text-center'>Failed to Reserve Hotel.</div>";
            }
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Featured Hotels</h2>

            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-hotels.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <section class="hotel-menu">
        <div class="container">
            <h2 class="text-center">Recommended Hotels</h2>

            <?php 
            
          
            //SQL Query
            $sql2 = "SELECT * FROM tbl_hotel WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
              
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="hotel-menu-box">
                        <div class="hotel-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not available.</div>";
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

                            <a href="<?php echo SITEURL; ?>reservation.php?hotel_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
              
                echo "<div class='error'>Hotel not available.</div>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Hotels</a>
        </p>
    </section>
  

    
    <?php include('partials-front/footer.php'); ?>