<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank | Transfer History Page</title>
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
    <!-- Transfer History Section Start-->
    <section class="transfer-hist">
        <h1 class="heading-title">Transfer History</h1>
        <table class="transfer-table">
            <thead>
                <tr>
                    <th>Sender ID</th>
                    <th>Reciver ID</th>
                    <th>Amount</th>
                    <th>Data / Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //start connection
                    $connection = mysqli_connect("localhost" , "root" , "" , "bank_db");
                    //try connection
                    if($connection -> connect_error){
                        die("Connection Failed:" . $connection -> connect_error);
                    }

                    // sql statement
                    $sql = "SELECT sender_id , reciver_id , amount , date from transfer";

                    $result = $connection -> query($sql);

                    if($result -> num_rows > 0) {
                        while($row = $result -> fetch_assoc())
                        {
                            echo "<tr><td>".$row["sender_id"]."</td><td>".$row["reciver_id"]."</td><td>".$row["amount"]."</td><td>".$row["date"];
                        }
                        echo "</table>";
                    }
                    else
                    {
                        echo "no result founded";
                    }

                    $connection -> close();
                ?>
            </tbody>
        </table>
    </section>
    <!-- Transfer History Section End -->
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