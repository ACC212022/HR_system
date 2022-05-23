<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Reservations</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th><center>No.<center></th>
                        <th><center>Hotel<center></th>
                        <th><center>Daily Rate<center></th>
                        <th><center>Customer Name<center></th>
                        <th><center>Reservation Date<center></th>
                        <th><center>Total<center></th>
                        <th><center>Status<center></th>
                        <th><center>Actions<center></th>
                    </tr>

                    <?php 
                        
                        $sql = "SELECT * FROM tbl_reservation ORDER BY id DESC"; // 
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                         
                            while($row=mysqli_fetch_assoc($res))
                            {
                                
                                $id = $row['id'];
                                $hotel = $row['hotel'];
                                $price = $row['price'];
                                $total = $row['total'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                $start_date = $row['start_date'];
                                $end_date = $row['end_date'];
                                
                                ?>

                                    <tr>
                                        <td><center><?php echo $sn++; ?>. <center></td>
                                        <td><center><?php echo $hotel; ?><center></td>
                                        <td><center>USD <?php echo $price; ?><center></td>
                                        <td><center><?php echo $customer_name; ?><center></td>
                                        <td><center><?php echo $start_date." - ".$end_date; ?><center></td>
                                        <td><center>USD <?php echo $total; ?><center></td>

                                        <td><center>
                                            <?php 
                                              

                                                if($status=="Booked")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        <center></td>

                                        <td><center>
                                            <a href="<?php echo SITEURL; ?>admin/update-reservation.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <center></td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            
                            echo "<tr><td colspan='12' class='error'>No Reservations Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>