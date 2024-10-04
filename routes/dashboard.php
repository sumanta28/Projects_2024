<?php
session_start();
if(!isset($_SESSION['userdata'])){
header("location: ../");
}

$userdata= $_SESSION['userdata'];
$groupsdata= $_SESSION['groupsdata'];

if($userdata['Status']==0){
    $Status= '<b style="color: red">Not Voted</b>';
}else{
    $Status= '<b style="color: green">Voted</b>';
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../CSS/stylesheet.css">
</head>
<body>

     <style>

        
        #backbtn{
    padding: 5px;
    border-radius: 5px;
    background-color: #6a89cc;
    color: white;
    border-radius: 5px;
    float: left;
    margin: 10px;
        }

        #logoutbtn{
    padding: 5px;
    border-radius: 5px;
    background-color: #6a89cc;
    color: white;
    border-radius: 5px;
    float: right;
    margin: 10px;
        }

        #Profile{
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group{
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;

        }

        #votebtn{
            padding: 5px;
            border-radius: 5px;
            background-color: #6a89cc;
            color: white;
            border-radius: 5px;
            float: left;

        }

        #mainpanel{
            padding: 10px;
        }

        #voted{
            padding: 5px;
            border-radius: 5px;
            background-color: green;
            color: white;
            border-radius: 5px;
            float: left;
        }

      

     </style>

     <div id="mainSection">

        <center>       
        <div id="headerSection">
            <a href="logout.php"> <button id="backbtn"> Back</button></a>
            <a href="logout.php"> <button id="logoutbtn">Logout</button></a>
            <h1>Online Voting System</h1>
        </div>
        </center>
        
        <hr>

        <div id="mainpanel">
        <div id="Profile">
            <center><img src="../uploads/<?php echo $userdata['Photo'] ?>" height="100" width="100"></center><br><br>
            <b>Name: <?php echo $userdata['Name']?></b><br><br>
            <b>Mobile: <?php echo $userdata['Mobile']?></b><br><br>
            <b>Address:<?php echo $userdata['Address']?></b><br><br>
            <b>Status: <?php echo $Status?></b><br><br>

        </div>
    
        <div id="Group">
            <?php
            if($_SESSION['userdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>

                <div>
                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['Photo'] ?>"height="100" width="100"><br>
                    <b>Group Name: </b> <?php echo $groupsdata[$i]['Name']?><br><br>
                    <b>Votes: </b> <?php echo $groupsdata[$i]['Votes']?><br><br>
                    <form action="../api/vote.php" method="POST">
                     <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['Votes'] ?>">
                     <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                     <?php
                        if($_SESSION['userdata']['Status']==0){
                        ?>
                        
                        <input type="submit" name="votebtn" value="vote" id="votebtn">
                        
                        <?php
                        }
                        else{
                        ?>
                        
                        <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                        
                        <?php
                        }
                        ?>
                    </form>
                </div>
                <br>
                <br>
                <hr>
                <?php
            }
                
            }else{

            }
            ?>

        </div>

        </div>


     
    
    </div>


</body>
</html>



