    
    <?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>



    <section class="hotel-search text-center">
        <div class="container">
            
            <h2>Hotels on <a href="#">"<?php echo $category_title; ?>"</a> Category</h2>

        </div>
    </section>




    
    <section class="hotel-menu">
        <div class="container">
            <h2 class="text-center">Available Hotels</h2>

            <?php 
            
                
                $sql2 = "SELECT * FROM tbl_hotel WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

              
                if($count2>0)
                {
                
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="hotel-menu-box">
                            <div class="hotel-menu-img">
                                <?php 
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

                                <a href="<?php echo SITEURL; ?>reservation.php?hotel_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                 
                    echo "<div class='error'>Hotel not Available.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>


    <?php include('partials-front/footer.php'); ?>