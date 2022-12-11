<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank | Transfer Page</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" type="text/css">
</head>
<body>
    <!-- Header Section Start -->
    <section class="header">
        <a href="index.php" class="logo">Bank System.</a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="customers.php">Customers</a>
            <a href="transfer.php">Transfer</a>
            <a href="tranferhistory.php">Transfer History</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <!-- Header Section End -->
    <!-- Transfer Section Start-->
    <section class="transfer">
        <h1 class="heading-title">Transfer Operation</h1>
        <div class="container">
            <form method="POST" class="transfer-form">
            <?php
                    //start connection
                    $connection = mysqli_connect("localhost" , "root" , "" , "bank_db");
                    //try connection
                    if($connection -> connect_error){
                        die("Connection Failed:" . $connection -> connect_error);
                    }

                    //checking 
                    if(isset($_POST['submit']))
                    {
                        $sender = $_POST['sender'];
                        $reciver = $_POST['reciver'];
                        $amount = $_POST['amount'];

                        if($sender <= 0 || $reciver <= 0 || $amount <= 0)
                        {
                            echo '<script>alert("Error Massage: Values must be more than zero!")</script>';
                        }
                        else
                        {
                            //for sender
                            $sqlGetSender = "SELECT * from customers where id=$sender";
                            $sender_query = mysqli_query($connection, $sqlGetSender);
                            $sqlSender = mysqli_fetch_array($sender_query);

                            //for reciver
                            $sqlGetReciver = "SELECT * from customers where id=$reciver";
                            $recive_query = mysqli_query($connection, $sqlGetReciver);
                            $sqlReciver = mysqli_fetch_array($recive_query);

                            if($amount < $sqlSender['balance'])
                            {
                                $new_balance_sender = $sqlSender['balance'] - $amount;
                                $sql = "UPDATE customers set balance=$new_balance_sender where id=$sender";
                                mysqli_query($connection, $sql);

                                $new_balance_reciver = $sqlReciver['balance'] + $amount;
                                $sql = "UPDATE customers set balance=$new_balance_reciver where id=$reciver";
                                mysqli_query($connection, $sql);


                                $sender_id = $sqlSender['id'];
                                $reciver_id = $sqlReciver['id'];

                                $Insertsql = "INSERT INTO `transfer` (`transfer_num`, `sender_id`, `reciver_id`, `amount`, `date`) VALUES ('NULL','$sender_id ','$reciver_id','$amount', current_timestamp())";

                                $insert = mysqli_query($connection, $Insertsql);

                                if($insert)
                                {
                                    echo '<script>alert("Successfully Transfering Operation")</script>';
                                }

                            }
                            else if($amount >= $sqlSender['balance'])
                            {
                                echo '<script>alert("Opps, the amount of money is higher than you have")</script>';
                            }
                        }
                    }
                ?>
                <label class="from">Transfer From</label>
                <input type="number" id="form" name="sender" placeholder="Enter customer Id">
                <label class="to">Transfer To</label>
                <input type="number" id="to" name="reciver" placeholder="Enter customer Id">
                <label class="amount">Amount</label>
                <input type="number" id="amount" name="amount" placeholder="Enter the amount">
                <div class="btnholder">
                    <button class="btn" type="submit" name="submit">Transfer</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Transfer Section End -->
    <!-- Footer Section Start -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <span>All rights goas to <a href="https://www.linkedin.com/in/mohamed-dwedar" target="_blank">Mohamed Dwedar</a> & <a href="https://www.thesparksfoundationsingapore.org/" target="_blank">The Sparks Foundation</a></span>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->
    <!-- custom js file link  -->
    <script type="text/javascript" src="js/script.js?v=<?php echo time();?>"></script>
</body>
</html>