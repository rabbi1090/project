<?php 
    include "conn.php";
    include "auth.php";

	if(!isset($_SESSION['room']))
	{
        $room = $username."bot";
		// $sql = "CREATE TABLE `epiz_27865341_user`.`$room` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL, `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = MyISAM;";
		$sql = "CREATE TABLE `user`.`$room` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL,  `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = InnoDB;";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			$_SESSION['room'] = $room;
			header("Location:bot.php");
		}
		else{
			$_SESSION['room'] = $room;
		}
	}
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		// $sql = "CREATE TABLE `epiz_27865341_user`.`$id` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL, `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = MyISAM;";
		$sql = "CREATE TABLE `user`.`$id` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL,  `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = InnoDB;";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			$_SESSION['room'] = $id;
		}
		else{
			$_SESSION['room'] = $id;
		}
	}
	$room = $_SESSION['room'];
	if(isset($_SESSION['folder']))
	{
		$folder = $_SESSION['folder'];
	}
	else{
		$folder = "asset/user.png";
	}
	$finalName = str_replace($username, "", $_SESSION['room']);
	$getImg ="SELECT * FROM `dp` WHERE `username` = '$finalName';";
	$imgResult = mysqli_query($conn, $getImg);
	if(mysqli_num_rows($imgResult)>0) {
	$imgData = mysqli_fetch_array($imgResult);
	$friendImg = $imgData['folder'];
	}
	else
	{
	$friendImg = "asset/user.png";
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">



    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->

    <link rel='stylesheet' href='css/hat.css'>
    <link rel="icon" href="img/hellochat2.png" type="image/x-icon">
    <title>My Inbox | HelloChat</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $(".submit").click(function() {
            $(".messages").animate({
                scrollTop: $(document).height()
            }, "fast");
        });
        setInterval(() => {
            $("#autodata").load("hatInput.php");
        }, 500);
        setInterval(() => {
            $("#autodata2").load("hatInput2.php");
        }, 500);
        $('#formbox').on("submit", function() {
            $.ajax({
                type: "POST",
                url: "insert.php",
                data: $(this).serialize(),
                success: function() {
                    $('#formbox').trigger('reset');
                },
                error: function() {
                    alert("ERROR! Message not sent");
                }
            });
            return false;
        });
    });

    $(".messages").animate({
        scrollTop: $(document).height()
    }, "fast");

    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });

    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    function goBack() {
        window.history.back();
    }
    </script>
</head>

<body>
    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                <div class="wrap">
                    <img id="profile-img" src="<?php echo $_SESSION['folder']; ?>" class="online" alt="" />
                    <p><?php echo $_SESSION['username']; ?></p>
                    <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                    <div id="status-options">
                        <ul>
                            <li id="status-online" class="active"><span class="status-circle"></span>
                                <p>Online</p>
                            </li>
                        </ul>
                    </div>
                    <div id="expanded">
                        <label for="email"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></label>
                        <input name="email" readonly type="text" value="<?php echo $_SESSION['email']; ?>" />
                        <label for="mobile"><i class="fa fa-phone fa-fw" aria-hidden="true"></i></label>
                        <input name="mobile" readonly type="text" value="+91 <?php echo $_SESSION['mobile']; ?>" />
                    </div>
                </div>
            </div>
            <div id="search">
                <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                <input type="text" placeholder="Search friends..." />
            </div>
            <div id="contacts">
                <ul id="autodata">


                </ul>
            </div>
            <div id="bottom-bar">
                <a href="find.php" style="text-decoration:none; color:white;"><button id="addcontact">
                        <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add Friend</span>
                    </button></a>
                <button id="settings"><a href="profile.php" style="text-decoration:none; color:white;">
                        <i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></a>
                </button>
            </div>
        </div>
        <div class="content">
            <div class="contact-profile">
                <img src="<?php echo $friendImg; ?>" alt="friend" />
                <p><?php
                $finalName = str_replace($username, "", $_SESSION['room']);
                echo $finalName;
                ?></p>
                <div class="social-media">
                    <a onclick='goBack()'><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <a href='home.php'><i class="fa fa-home" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="messages">
                <ul id="autodata2">

                    <small>&nbsp;</small>
                </ul>
            </div>
            <div class="message-input">
                <div class="wrap">
                    <form id="formbox" autocomplete="off">
                        <input type="text" required name="chat" placeholder="Write your message..." />

                        <div id="user_details"></div>
                        <div id="user_model_details"></div>
                        
						
						<button class="submit" name="submit"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



<script>
$(document).ready(function() {

    fetch_user();

    setInterval(function() {
        update_last_activity();
        fetch_user();
        update_chat_history_data();
    }, 5000);

    function fetch_user() {
        $.ajax({
            url: "fetch_user.php",
            method: "POST",
            success: function(data) {
                $('#user_details').html(data);
            }
        })
    }

    function update_last_activity() {
        $.ajax({
            url: "update_last_activity.php",
            success: function() {

            }
        })
    }

    function make_chat_dialog_box(to_user_id, to_user_name) {
        var modal_content = '<div id="user_dialog_' + to_user_id +
            '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
        modal_content +=
            '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
            to_user_id + '" id="chat_history_' + to_user_id + '">';
        modal_content += fetch_user_chat_history(to_user_id);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id +
            '" class="form-control chat_message"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        modal_content += '<button type="button" name="send_chat" id="' + to_user_id +
            '" class="btn btn-info send_chat">Send</button></div></div>';
        $('#user_model_details').html(modal_content);
    }

    $(document).on('click', '.start_chat', function() {
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        make_chat_dialog_box(to_user_id, to_user_name);
        $("#user_dialog_" + to_user_id).dialog({
            autoOpen: false,
            width: 400
        });
        $('#user_dialog_' + to_user_id).dialog('open');
        $('#chat_message_' + to_user_id).emojioneArea({
            pickerPosition: "top",
            toneStyle: "bullet"
        });
    });

    $(document).on('click', '.send_chat', function() {
        var to_user_id = $(this).attr('id');
        var chat_message = $('#chat_message_' + to_user_id).val();
        $.ajax({
            url: "insert_chat.php",
            method: "POST",
            data: {
                to_user_id: to_user_id,
                chat_message: chat_message
            },
            success: function(data) {
                //$('#chat_message_'+to_user_id).val('');
                var element = $('#chat_message_' + to_user_id).emojioneArea();
                element[0].emojioneArea.setText('');
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    });

    function fetch_user_chat_history(to_user_id) {
        $.ajax({
            url: "fetch_user_chat_history.php",
            method: "POST",
            data: {
                to_user_id: to_user_id
            },
            success: function(data) {
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    }

    function update_chat_history_data() {
        $('.chat_history').each(function() {
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        });
    }

    $(document).on('click', '.ui-button-icon', function() {
        $('.user_dialog').dialog('destroy').remove();
    });

    $(document).on('focus', '.chat_message', function() {
        var is_type = 'yes';
        $.ajax({
            url: "update_is_type_status.php",
            method: "POST",
            data: {
                is_type: is_type
            },
            success: function() {

            }
        })
    });

    $(document).on('blur', '.chat_message', function() {
        var is_type = 'no';
        $.ajax({
            url: "update_is_type_status.php",
            method: "POST",
            data: {
                is_type: is_type
            },
            success: function() {

            }
        })
    });

});
</script>



