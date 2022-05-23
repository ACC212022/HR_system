<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Reservation</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
              
                $id=$_GET['id'];

               
                $sql = "SELECT * FROM tbl_reservation WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $hotel = $row['hotel'];
                    $price = $row['price'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                    $reservation_date = $row['reservation_date'];
                    $start_date = $row['start_date'];
                    $end_date = $row['end_date'];
                    $total = $row['total'];
                }
                else
                {
               
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
            else
            {
             
                header('location:'.SITEURL.'admin/manage-reservation.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Hotel</td>
                    <td><b> <?php echo $hotel; ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b> USD <?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Date Booked</td>
                    <td>
                        <b><?php echo $reservation_date; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Reservation Date</td>
                    <td>
                        <b><?php echo $start_date; ?> - <?php echo $end_date; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Booked"){echo "selected";} ?> value="Booked">Booked</option>
                           
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>


                <tr>
                    <td>Total Price</td>
                    <td>
                        <b>USD <?php echo $total; ?></b>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];

                //Update the Values
                $sql2 = "UPDATE tbl_reservation SET 
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Reservation Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Reservation.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
