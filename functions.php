<?php
//checks if there is a logged in user
function checkLogin($con){
    if(isset($_SESSION['TIN'])){

        $ID = $_SESSION['TIN'];
        $query = "select * from users where TIN ='$ID' limit 1";
        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) >0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }else{
        header("Location: login.php");
        die;
    }

}

//function for head section
function head_section(){  
    ?>
	<nav class="navbar">
            <div class="navbar__container">
                <h1>KINDERCARE E-ASSESSMENT SYSTEM</h1>
                <div class="navbar__toggle" id="mobile-menu">
                    
                </div>
        
            </div>
	</div>
    <?php
}
// function section contains the middle part of web pages and men u
function section(){
    

	echo '<div class="content home-content">';
        echo '<div class="content-text">';
              
               ?>
               
               <div class="sidebar">
                       <ul class="">
                    <li class="dashitem">
                    <form action="index.php" method="post" class="dashlink">
                        <input type = "submit" name="" value="Dashboard" id="target"/>
                    </form>
                    </li>
                    <li class="dashitem">
                    <form action="registerpage.php" method="post" class="dashlink">
                        <input type = "submit" name="register" value="Register Pupils" id="target"/>
                    </form>
                    </li>
                    <li class="dashitem">
							<form action="uploadpage.php" method="post" class="dashlink">
								<input type = "submit" name="upload" value="Upload Assignments" />
							</form>
                    </li>
                    <li class="dashitem">
							<form action="viewRequestpage.php" method="post" class="dashlink">
								<input type = "submit" name="view" value="View Requests" />
							</form>
                    </li>
                    <li class="dashitem">
						<form action="deactivatepage.php" method="post" class="dashlink">
								<input type = "submit" name="deactivate" value="Deactivate Pupil" />
							</form>';
                    </li>
                    <li class="dashitem">
						<form action="" method="post" class="dashlink">
								<input type = "submit" name="scores" value="Assignment Scores" />
							</form>';
                    </li>
                    <li class="dashitem">
						<form action="logout.php" method="post" class="dashlink">
								<input type = "submit" name="" value="log out" />
							</form>
                    </li>
                    
                </ul>
                </div>
                       
               <?php
              
              
                        
					
            
            echo '</div>';
        echo '</div>';
        echo  '</td>';
        echo  '</tr>';
       echo  '</table>';
}

//footer for all pages
function footer_section(){
	echo '<footer class="footer">';

            echo '<div>';
                echo '<p>KinderCare</p>';
            echo '</div>';
	echo '</footer>';		
}

//function for registering pupils
function register(){
    ?>
    <h2>Register Pupil</h2>
    <table class = "clicked" id="" >
                <tr class="">
                    <th >User Code</th>
                    <th >First Name</th>
                    <th >Last Name</th>
                    <th >Telephone Number</th>
                </tr>
                <form action="register.php" method="POST">
                        <tr>
                        <td><input type="text" placeHolder = "" name = "userCode"></td>
                        
                        <td><input type="text" placeHolder = "" name = "firstname"></td>
                        
                        <td><input type="text" placeHolder = "" name = "lastname"></td>
                        
                        <td><input type="text" placeHolder = ""  name = "Pnumber"></td>
                        </tr>
                    </table>
                        <button type = "submit" class="">Register</button> 
                        
                </form>
                <h2>Registered Pupils</h2>
            <table class = "b" id="" >
                        <tr class="b">
                            <th >User Code</th>
                            <th >First Name</th>
                            <th >Last Name</th>
                            <th >Telephone No</th>
                            <th >Status</th>
                        </tr>
            <?php
            include('connection.php');
            if($connection->connect_error){
                die('Connection Failed : ' .$connection->connect_error);
            }
            $sql = "SELECT UserCode, FirstName, LastName, TelephoneNo, status1 from pupils ORDER BY TimeStamp";
            $result = $connection->query($sql);
            if($result-> num_rows > 0){
                while($row = $result-> fetch_assoc()){
                    echo "<tr class='b'>";
                    echo "<td>". $row["UserCode"]."</td>";
                    echo "<td>". $row["FirstName"]."</td>";
                    echo "<td>". $row["LastName"]."</td>";
                    echo "<td>". $row["TelephoneNo"]."</td>";
                    echo "<td>". $row["status1"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{
                echo "0 result";
            }
            ?>
            
         </table>
         <?php
 


}

//function for uploading an assignment
function upload(){
    ?>
    <div class="clicked">
        <p>Upload assignment</p>
        <h1>Select Characters (A-Z)</h1>
        <p>Characters</p>
        <form action="upload.php" method="POST">
                <select name="one" id="">
                    <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="two" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>


                </select>
                <select name="three" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="four" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="five" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="six" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="seven" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>

                </select>
                <select name="eight" id="">
                <option value=""></option>
                    <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    <option value="D">D</option><option value="E">E</option><option value="F">F</option>
                    <option value="G">G</option><option value="H">H</option><option value="I">I</option>
                    <option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option>
                    <option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                    <option value="U">U</option><option value="V">V</option><option value="W">W</option>
                    <option value="X"></option><option value="Y">Y</option><option value="Z">Z</option>


                </select>
                <br><br>
                <label>Date</label>
                <input type="date" name="date" value="date">
                <br><br>
                <label>StartTime</label>
                <input type="time" name="starttime" value="starttime">
                <label>EndTime</label>
                <input type="time" name="endtime" value="endtime"> <br><br>

                <button type="submit">Upload</button>

        </form>
    </div> 
    
    <h2>Assignments</h2>
            <table class = "b" id="" >
                        <tr class="b">
                            <th >ID</th>
                            <th >Characters</th>
                            <th >Date</th>
                            <th >Start Time</th>
                            <th >End Time</th>
                        </tr>
            <?php
            include('connection.php');
            if($connection->connect_error){
                die('Connection Failed : ' .$connection->connect_error);
            }
            $sql = "SELECT * from assignment ORDER BY AssignmentID";
            $result = $connection->query($sql);
            if($result-> num_rows > 0){
                while($row = $result-> fetch_assoc()){
                    echo "<tr class='b'>";
                    echo "<td>". $row["AssignmentID"]."</td>";
                    echo "<td>". $row["AssignmentCharacters"]."</td>";
                    echo "<td>". $row["Date"]."</td>";
                    echo "<td>". $row["StartTime"]."</td>";
                    echo "<td>". $row["endtime"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{
                echo "0 result";
            }
            ?>
            
         </table>
         <?php
    
}

//function for viewing activation requests
function viewRequests(){
    ?>
    <h2>Activation Requests</h2>
            
            <?php
            include('connection.php');
            if($connection->connect_error){
                die('Connection Failed : ' .$connection->connect_error);
            }
            $sql = "SELECT * from activationrequest";
            $result = $connection->query($sql);
            if($result-> num_rows > 0){
                ?>
                <table class = "b" id="" >
                        <tr class="b">
                            <th >RequestID</th>
                            <th >User Code</th>
                            <th >Action</th>
                        </tr>
                <?php
                while($row = $result-> fetch_assoc()){
                    echo "<tr class='b'>";
                    echo '<form action="reActivate.php" method="POST">';
                    echo "<td>";
                    ?>
                    <input type = "text" name="RequestID" value="<?php echo $row['RequestID']; ?>" readonly />
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <input type = "text" name="UserCode" value="<?php echo $row['UserCode']; ?>" readonly />
                    <?php
                    echo "</td>";
                    echo "<td>".'<button type = "submit" name="">Reactivate</button>'."</td>";
                    echo "</tr>";
                    echo '</form>';
                }
                echo "</table>";
            }
            else{
                echo "There are not any activation requests";
            }
            ?>
            
         </table>
         <?php
    
}


//funnction for deactivating a pupil
function deactivate(){
    ?>
    <h2>Deactivate Pupils</h2>
            <form action="deactivate.php" method="POST">
            <label>Enter Pupil UserCode</label><br>
            <input type="text" placeHolder = "Usercode"  name = "userCode"><br><br>
            <button type = "submit" class="btn btn-primary">Deactivate</button><br><br>
            </form>
         <?php
    
}

function dashboard(){
    include('connection.php');
    $query1 = "SELECT COUNT(UserCode) as totalpupils FROM pupils";
    $registered1 = mysqli_query($connection,$query1);
    $registered2=mysqli_fetch_assoc($registered1);
    $registered3=$registered2['totalpupils'];
    echo '<div class="card"><p>Total Number of Pupils</p>';
    echo $registered3;
    echo '</div>';

    
    $query2 = "SELECT COUNT(AssignmentID) as totalassign FROM assignment";
    $assign1 = mysqli_query($connection,$query2);
    $assign2=mysqli_fetch_assoc($assign1);
    $assign3=$assign2['totalassign'];
    echo '<div class="card"><p>Total Number of assignments</p>';
    echo $assign3;
    echo '</div>';
    

}
?>


