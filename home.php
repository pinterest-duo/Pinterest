<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pinterest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pin_style.css" type="text/css"/>
    <link rel="stylesheet" href="css/nav_style.css" type="text/css"/>
    <link rel="icon" href="images/pinterest_logo.ico"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.pin').hover(
                function(){
                    $(this).children(".dropdownContainer").css({'display':'block'});
                    $(this).children(".saveContainer").css({'display':'block'});
                },
                function () {
                    $(this).children(".dropdownContainer").css({'display':'none'});
                    $(this).children(".saveContainer").css({'display':'none'});
                }
            );
            $('.boardDropdown').click(function(){
                $('.boardSelectionContainer').toggle();
                // $('.pin').unbind('mouseenter mouseleave');
            });

            /* $('body').click(function(event){
                if(!$(event.target).closest('.dropdownContainer').length && !$(event.target).is('.dropdownContainer')) {
                    $(".dropdownContainer").hide();
                    $('.pin').on('mouseenter mouseleave');
                }
            }); */

            // $('.dropdownContainerForm').submit(function(event){
            //     console.log("form submitted");
            //     // event.preventDefault();
            // });

            /* $('.savePinBoard').click(function(){
                var pin_Url = $(this).children('input.pin_url').val();
                var board_id = $(this).children('input.board_id').val();
                var dataString = 'pin_Url' + pin_Url + '&board_id' + board_id;

                console.log("form submitted");
                $.ajax({
                    type: "POST",
                    url: "save_pin.php", 
                    data: dataString,
                    success: function(){
                        $(this).parentNode(".dropdownContainer").css({'display':'none'});
                    }
                });
                return false;
                // event.preventDefault();
            }); */

            /* $('.boardOptionContainer').click(function(){
                // console.log("div form submitted");
                this.parentNode.submit(function(e){
                    console.log("form submitted");
                    e.preventDefault();
                });
            }); */
            
        });
    </script>
    <?php 
    // require('save_pin.php');
    ?>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand navbar-light">
        <a class="navbar-brand" href="home.html"><img src="images/pinterest_logo.png" alt="Pinterest" height="27px"></a>
        <input class="form-control mr-lg-2 searchBar" id="searchBar" type="search" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Following</a>
            </li>
            <li class="nav-item">
                <!-- Replace with actual user pic -->
                <a class="nav-link" href="profile.html"><img class="profileImg" src="https://cdn.pixabay.com/photo/2016/02/19/10/41/palm-tree-1209358_960_720.jpg"></a>
            </li>
            <li class="nav-item">
                <!-- Replace Username with actual username -->
                <a class="nav-link" href="profile.html">Username</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navEllipse" href="">...</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
    <div class="row">
        
        <?php 
            require('includes/mysqli_connect.php');
            
            // Get all of this user's board names from the database and put it into an array
            // ****(user 1 right now, replace with current user in future)*****
            $currentUser = 1;
            $board_query = "SELECT board_name, cover_pin_url FROM boards WHERE user_id = $currentUser;";
            $board_run = mysqli_query($dbc, $board_query);
            $numBoards = mysqli_num_rows($board_run);
            if($numBoards != 0){
                $boards = array();
                $boardImgs = array();
                while($board_row = mysqli_fetch_array($board_run, MYSQLI_ASSOC)){
                    array_push($boards, $board_row['board_name']);
                    array_push($boardImgs, $board_row['cover_pin_url']);
                }
            }            
            // Get ALL pins from the database 
            $pin_query = "SELECT * FROM pins;";
            $pin_run = mysqli_query($dbc, $pin_query);
            // $numPins = mysqli_num_rows($pin_run);
                
            // Display every pin
            while($row = mysqli_fetch_array($pin_run, MYSQLI_ASSOC)){
                echo '<div class="col-auto text-center pin">';
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
                        $currBoard = 0;
                    }
                echo '</div>
                        <div class="boardSelectionBottomCreate">
                            <div class="createButton">+</div>
                            <p>Create Board</p>
                        </div>
                    </div>
                    </div>';
                }
                else{
                    echo '<div class="saveContainer">
                        <!-- This should trigger a create a board popup -->
                        <div class="savePinwImg" onclick=""><img class="pinIcon" src="images/pinButton.png"/>Save</div>
                    </div>';
                }
                echo '
                    <img class="pinImg" src="'.$row['pin_url'].'"/>
                    <a href="" class="ellipses">...</a>
                </div>';
            }
        ?>

<!-- HTML BEGINS HERE -->

        <div class="col-auto text-center pin noshow">
            <!-- Display dropdown menus at the top of the pin -->
            <div class="dropdownContainer">
                <!-- The dropdown "button" -->
                <div class="boardDropdown">Board Name<img src="images/dropdown_arrow.png" alt="&caron;"></div>
                <form class="dropdownContainerForm" action="home.php" method="POST">
                    <!-- Pin and board ids will be populated using PHP -->
                    <input type="hidden" value="1" class="pin_id" name="pin_id">
                    <input type="hidden" value="https://cdn.pixabay.com/photo/2016/02/19/11/46/night-1209938_960_720.jpg" class="pin_url" name="pin_url">
                    <input type="hidden" value="1" class="board_id" name="board_id">
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
                        
                        <!-- Each item in the dropdown selection: TO BE POPULATED VIA PHP-->
                        <form class="dropdownContainerForm dropdownOptionForm" action="home.php" method="POST">
                            <div class="boardOptionContainer">
                                <img src="https://cdn.pixabay.com/photo/2016/02/19/10/41/palm-tree-1209358_960_720.jpg" class="boardThumb">
                                <p class="boardNameDropdown">Board 2</p>
                                <!-- <div class="savePinBoard" onclick="">Save</div> -->
                                <!-- Pin and board ids will be populated using PHP -->
                                <input type="hidden" value="1" class="pin_id" name="pin_id">
                                <input type="hidden" value="https://cdn.pixabay.com/photo/2014/12/15/17/16/night-sky-569319_960_720.jpg"  class="pin_url" name="pin_url">
                                <input type="hidden" value="1" class="board_id" name="board_id">
                                <input type="submit" class="savePinBoard" value="Save">
                            </div>
                        </form>
                    </div>
                    <div class="boardSelectionBottomCreate">
                        <div class="createButton">+</div>
                        <p>Create Board</p>
                    </div>
                </div>

            </div>
            <!-- Actual pin image -->
            <img class="pinImg" src="https://cdn.pixabay.com/photo/2014/12/15/17/16/night-sky-569319_960_720.jpg"/>
            <a href="" class="ellipses">...</a>
        </div>

        <div class="col-auto text-center pin noshow">
            <!-- Save pin button only if user has no boards yet -->
            <div class="saveContainer">
                <!-- This should trigger a create a board popup -->
                <div class="savePinwImg" onclick=""><img class="pinIcon" src="images/pinButton.png"/>Save</div>
            </div>
            <img class="pinImg" src="https://cdn.pixabay.com/photo/2016/02/19/10/41/palm-tree-1209358_960_720.jpg"/>
            <a href="" class="ellipses">...</a>
        </div>

        <?php mysqli_close($dbc);?>
        <!-- <?php ?> -->
    </div>
        
    </div>
    <!-- Creating the nav without bootstrap -->
    <!-- <div id="nav">
        <a id="navLogo" href="home.html"><img src="images/pinterest_logo.png" alt="Pinterest" height="27px"></a>
        <input id="searchBar" name="searchBar" placeholder="Search">
        <ul id="navList">
            <li>Home</li>
            <li>Following</li>
            <li>Username</li>
            <li>Messages</li>
            <li>Notifications</li>
            <li>More</li>
        </ul>
    </div> -->
</body>

</html>