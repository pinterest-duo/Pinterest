<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PINS STILL NEED TO BE WITH BLACK BACKGROUND/OVERLAY ON HOVER -->
    <title>Pinterest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="css/nav_style.css" type="text/css"/>
    <link rel="stylesheet" href="css/pin_style.css" type="text/css"/>
    <link rel="stylesheet" href="css/board_modal.css" type="text/css"/>
    <link rel="icon" href="images/pinterest_logo.ico"/>
</head>

<body>

    <?php require('nav.html');?>

    <div class="container-fluid">
    <div class="row">
    <!-- <div class="containit"> -->
        
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

    </div>
        
    </div>

    <div class="modal"></div>

    <div class="createBoard">
        <div class="createBoardTitle">
            <h2>Choose board</h2>
            <div class="modalCloseBtn"><span class="closeBtn">x</span></div>
        </div>
        <div>
            <div class="createBoard_PinAside">
                <img class="pinPreview" src="images/paris.jpg"/>
                <!-- Populated by pin, this value by default -->
                <div class="createBoard_PinDesc"><p>Tell us about this Pin...</p><img src="images/edit.png" alt="Edit"/></div>
                <form class="createBoard_Form" method="POST" action="create_board.php">
                    <textarea class="boardPinDescField" name="pin_desc" type="text" placeholder="Tell us about this Pin..."></textarea>  
            </div>
            <div class="createBoard_WordAside">
                <div class="createBoard_PinTitle"></div>
                
                    <div class="createBoard_Input">
                        <label class="suggestedBoardNames" for="board_name">Name</label>
                        <input class="boardNameField" name="board_name" type="text"/>
                    </div>
                    <div class="createBoard_Input">
                        <label class="suggestedBoardNames" for="is_secret_board">Secret</label>
                        <label class="switch">
                            <input class="secretSwitch" type="checkbox" value="yes">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="createBoard_Input last">
                        <label class="suggestedBoardNames" for="collab">Add Collaborators (optional)</label>
                        <input  class="form-control md-auto searchBar" type="search" name="collab" placeholder="Search by name or email"/>
                    </div>

                    <div class="createBoard_belowTitle">
                        <div class="createButtonBoard">
                            <div class="createButtonModal">+</div>
                            <h5>Create Board</h5>
                        </div>
                        <div class="suggestedBoardNamesContainer">
                            <div class="suggestedBoardNames">
                                <h5 class="suggestedBoardNamesTitle">Suggested board names</h5>
                                <div class="suggestedBoardName">
                                    <div class="addBoardName">+</div>
                                    <p>Suggestion 1</p>
                                </div>
                                <div class="suggestedBoardName">
                                    <div class="addBoardName">+</div>
                                    <p>Suggestion 2</p>
                                </div>
                                <div class="suggestedBoardName">
                                    <div class="addBoardName">+</div>
                                    <p>Suggestion 3</p>
                                </div>
                                <div class="suggestedBoardName">
                                    <div class="addBoardName">+</div>
                                    <p>Suggestion 4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="createBoardBottom">
                        <div class="cancelBtn">Cancel</div>
                        <input class="createBoardPinUrl" type="hidden" name="pin_url" value=""/>
                        <input type="submit" class="createBtn" value="Create"/>
                    </div>
                </div>
            </form>
        </div>
    </div>    

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

            $('.dropdownContainerForm').submit(function(event){
                console.log("form not submitted");

                // Stop the page from refreshing when the form submits
                event.preventDefault();
                
                // Save the pin to the database using ajax
                $.ajax({
                    // URL = location of the php to run on form submission
                    url : "save_pin.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (data) {
                        console.log("pin has been saved");
                    },
                    error: function (jXHR, textStatus, errorThrown) {
                        console.log("error: " + errorThrown);
                    }
                });
                $('.boardSelectionContainer').hide();
            });

            $('.boardSelectionBottomCreateForm').submit(function(event){
                event.preventDefault();

                var fields = $(this).serializeArray();
                var arr = [];

                jQuery.each( fields, function( i, field ) {
                    arr[i] = (field.value);
                    console.log(field.value);
                });

                $('.createBoard_PinAside img.pinPreview').attr("src", arr[1]);
                if(arr[2] != ""){
                    $('.createBoard_PinDesc').html(arr[2]);
                }
                // Set the url for the pin in the modal
                $('input.createBoardPinUrl').val(arr[1])

                $('.modal').show();
                $('.createBoard').show();

            });

            $('.createBoard_Form').submit(function(){
                // Stop the page from refreshing when the form submits
                // event.preventDefault();
                
                // Save the pin to the database using ajax
                // $.ajax({
                //     // URL = location of the php to run on form submission
                //     url : "create_board.php",
                //     type: "POST",
                //     data: $(this).serialize(),
                //     success: function (data) {
                //         console.log("board has been made and pin has been saved");
                //     },
                //     error: function (jXHR, textStatus, errorThrown) {
                //         console.log("error: " + errorThrown);
                //     }
                // });

            });

            // Modal Display and exit
            $('.boardSelectionBottomCreate').click(function(){
                // $('.modal').show();
                // $('.createBoard').show();
                $(this).children('.boardSelectionBottomCreateForm').submit();
            });

            $('.modalCloseBtn').click(function(){
                $('.modal').hide();
                $('.createBoard').hide();
                $('.boardSelectionContainer').toggle();
                
                // Resetting the create board modal
                $('.createBoard_Input').hide();
                $('.createButtonBoard').show();
                $('.suggestedBoardNamesContainer').show();
                $('.createBoard_PinTitle').show();
                
                $('input.boardNameField').val('');
                $('input.searchBar').val('');
            });
            $('.modal').click(function(){
                $('.modal').hide();
                $('.createBoard').hide();
                $('.boardSelectionContainer').toggle();
                
                $('.createBoard_Input').hide();
                $('.createButtonBoard').show();
                $('.suggestedBoardNamesContainer').show();
                $('.createBoard_PinTitle').show();

                $('input.boardNameField').val('');
                $('input.searchBar').val('');
            });

            // Modal interactivity
            // Switch to create board view
            $('.createButtonBoard').click(function(){
                $('.createBoardTitle h2').html('Create Board');
                $('.createBoard_Input').show();
                $('.createBoardBottom').show();
                $('.createButtonBoard').hide();
                $('.suggestedBoardNamesContainer').hide();
                $('.createBoard_PinTitle').hide();
            });
            // Suggestions interaction
            $(".suggestedBoardName").click(function(){
                $('.createBoardTitle h2').html('Create Board');
                $('.createBoard_Input').show();
                $('.createBoardBottom').show();
                $('.createButtonBoard').hide();
                $('.suggestedBoardNamesContainer').hide();
                $('.createBoard_PinTitle').hide();
                console.log($(this).children('p').val());
                // $('.boardNameField').val($(this).children('p').val());
                $('input.boardNameField').val();
            });
            $('.cancelBtn').click(function(){
                $('.createBoardTitle h2').html('Choose Board');
                $('.createBoard_Input').hide();
                $('.createBoardBottom').hide();
                $('.createButtonBoard').show();
                $('.suggestedBoardNamesContainer').show();
                $('.createBoard_PinTitle').show();
            });

            // Pin Description Field
            $('.createBoard_PinDesc').click(function(){
                $('.boardPinDescField').show();
                $(this).hide();
            });
            $('.createBoard_PinDesc img').click(function(){
                $('.boardPinDescField').show();
                $(this).hide();
            });
            $('.boardPinDescField').blur(function(){
                console.log($(this).val());
                var pinDesc = ($(this).val());
                // if(pinDesc != "" || pinDesc != " " || pinDesc != null){
                    // var desc = $(this).parent().children('.createBoard_PinDesc p');
                    // console.log(desc.val());
                    // desc.innerHTML = pinDesc;
                // }
                // $('.createBoard_PinDesc p').html(pinDesc);
                $('.createBoard_PinDesc p').html($(this).val());
                $(this).hide();
                $('.createBoard_PinDesc').show();
            });

        });
    </script>
</body>

</html>