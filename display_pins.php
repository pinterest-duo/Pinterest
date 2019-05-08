<?php 
            require('includes/mysqli_connect.php');
            
            // Get all of this user's board names from the database and put it into an array
            // ****(user 1 right now, replace with current user in future)*****
            $currentUser = 1;

            // Create and run the query for getting the boards for this user
            $board_query = "SELECT board_name, cover_pin_url FROM boards WHERE user_id = $currentUser;";
            $board_run = mysqli_query($dbc, $board_query);
            $numBoards = mysqli_num_rows($board_run);
            // If the user has boards, add them and their corresponsing cover image urls to arrays
            if($numBoards != 0){
                $boards = array();
                $boardImgs = array();
                while($board_row = mysqli_fetch_array($board_run, MYSQLI_ASSOC)){
                    array_push($boards, $board_row['board_name']);
                    array_push($boardImgs, $board_row['cover_pin_url']);
                }
            }            
            // Get ALL pins from the database 
            $pin_query = "SELECT * FROM pins ORDER BY pin_date DESC;";
            $pin_run = mysqli_query($dbc, $pin_query);
            $numPins = mysqli_num_rows($pin_run);
            
            // Display every pin
            while($row = mysqli_fetch_array($pin_run, MYSQLI_ASSOC)){
                echo '<div class="col-auto text-center pin" id="pin'.$row['pin_id'].'">';                
                // Only create the board dropdown if the user has at least one board
                if($numBoards != 0){
                    echo '
                    <div class="dropdownContainer">
                        <!-- The dropdown "button" -->
                        <div class="boardDropdown">'.$boards[0].'<img src="images/dropdown_arrow.png" alt="&caron;"></div>
                        <form class="dropdownContainerForm" action="save_pin.php" method="POST">
                            <!-- Pin and board ids will be populated using PHP -->
                            <input type="hidden" value="'.$row['pin_id'].'" name="pin_id">
                            <input type="hidden" value="'.$row['pin_url'].'" name="pin_url">
                            <input type="hidden" value="'.$row['board_id'].'" name="board_id">
                            <input type="submit" class="savePin" value="Save">
                        </form>
        
                        <!-- The dropdown menu for other boards -->
                        <!-- A container to hold the entire dropdown menu -->
                        <div class="boardSelectionContainer">
                            <img src="images/dropdownMenuArrow.png" class="dropdownMenuArrow">
                            
                            <!-- Container to hold the top part of the dropdown menu -->
                            <div class="boardSelection">
                                <!-- Search bar for the top of the dropdown -->
                                <div class="searchBoardSelection">
                                    <input class="form-control md-auto searchBar" type="search" placeholder="Search">
                                </div>
                                <h4 class="allBoardsText">All boards</h4>
                                ';
                    $currBoard = 0;
                    // Display all of the board suggestions
                    foreach($boards as $board){
                        echo '                        
                        <form class="dropdownContainerForm dropdownOptionForm" action="save_pin.php" method="POST">
                            <div class="boardOptionContainer">
                                <img src="'.$boardImgs[$currBoard].'" class="boardThumb">
                                <p class="boardNameDropdown">'.$board.'</p>
                                <input type="hidden" value="'.$row['pin_id'].'" name=pin_id">
                                <input type="hidden" value="'.$row['pin_url'].'" name="pin_url">
                                <input type="hidden" value="'.$row['board_id'].'" name="board_id">
                                <input type="submit" class="savePinBoard" value="Save">
                            </div>
                        </form>';
                        $currBoard++;
                    }
                echo '</div>
                        <div class="boardSelectionBottomCreate">
                            <form class="boardSelectionBottomCreateForm" method="POST">
                            <div class="createButton">+</div>
                            <p>Create Board</p>
                            <input type="hidden" value="'.$row['pin_id'].'" name=pin_id">
                            <input type="hidden" value="'.$row['pin_url'].'" name="pin_url">
                            <input type="hidden" value="'.$row['blurb'].'" name="blurb">
                            </form>
                        </div>
                    </div>
                    </div>';
                }
                // Display a save button if the user has no boards
                else{
                    echo '<div class="saveContainer">
                        <!-- This should trigger a create a board popup -->
                        <div class="savePinwImg" onclick=""><img class="pinIcon" src="images/pinButton.png"/>Save</div>
                    </div>';
                }
                // Add the pin image
                echo '
                <div class="pinImg"><img class="pinImg" src="'.$row['pin_url'].'"/></div>    
                    <a href="" class="ellipses">...</a>
                </div>';
            }
            mysqli_close($dbc);
        ?>