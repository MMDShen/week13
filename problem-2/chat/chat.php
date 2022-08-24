<?php
session_start();
$messages = json_decode(file_get_contents('data.json'), true) ?? [];
// $users = json_decode(file_get_contents('../dataBase/dataBase.json'), true) ?? [];

if (isset($_POST['send']) and !$_SESSION['user']['blocked']) {
    if (strlen($_FILES['file']['name']) > 0) {
        move_uploaded_file($_FILES['file']['tmp_name'], '../images/' . $_FILES['file']['name']);
        $message = array(
            "sender" => $_SESSION['user']['username'],
            "content" => '../images/' . $_FILES['file']['name'],
            "seen" => false,
            "type" => 'image',
            "blocked" => false
        );
        $messages[] = $message;
        file_put_contents('data.json', json_encode($messages));
    }


    if (strlen($_POST['content']) > 0) {
        $message = array(
            "sender" => $_SESSION['user']['username'],
            "content" => $_POST['content'],
            "seen" => false,
            "type" => 'text'
        );

        $messages[] = $message;
    }
    file_put_contents('data.json', json_encode($messages));
}


for ($i = 0; $i < count($messages); $i++) {
    if (isset($_POST['delete' . $i])) {
        $messages = array_merge(array_slice($messages, 0, $i), array_slice($messages, $i + 1, count($messages)));
        file_put_contents('data.json', json_encode($messages));
        break;
    }
    if (isset($_POST['edit' . $i])) {
        if (strlen($_POST['edited-content' . $i]) > 0) {
            $messages[$i]['content'] = $_POST['edited-content' . $i];
            file_put_contents('data.json', json_encode($messages));
            break;
        }
    }
    if (isset($_POST['block' . $i])) {
        $blockedUserName = $messages[$i]['sender'];
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['username'] === $blockedUserName) {
                if ($users[$i]['blocked'])
                    $users[$i]['blocked'] = false;
                else $users[$i]['blocked'] = true;
                file_put_contents('../dataBase/dataBase.json', json_encode($users));
                break;

            }
        }

        break;
    }

}


?>

<html lang="en">
<head>
    <script src="../jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>
    <script src="../jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="customStyle.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>


</head>

<body class="">

<form action="" method="post" enctype="multipart/form-data">

    <div class="page-content page-container" id="page-content">

        <div class="padding">

            <div class=" container bg-gray-300 py-3 d-flex md:flex-row flex-col justify-around gap-3 rounded-5">

                <!--                LEFT CONTAINER-->
                <div class="text-light text-start md-col-2 font-mono p-3 text-center">
                    <div class="text-center flex justify-content-center  px-1 border-4 border-primary rounded-5"
                         style="background-color: #1f304e">
                        <table class="text-light text-center lg:text-xl md:text-sm sm:text-xl">
                            <thead class="mx-auto">
                            <tr class="p-2">
                                <th class="px-2">name</th>
                                <th class="px-2">username</th>
                                <th class="px-2">State</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td class="px-2"><?php echo $_SESSION['user']['name'] ?></td>
                                <td class="px-2"><?php echo $_SESSION['user']['username'] ?></td>
                                <td class="px-2 <?php echo $_SESSION['user']['blocked'] ? 'text-red-700' : 'text-green-600'; ?>"><?php echo $_SESSION['user']['blocked'] ? "Blocked" : "Activate" ?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card card-bordered rounded-5" style="background-color: #1f304e;">


                        <div class="card-header bg-primary">
                            <h4 class="card-title"><strong><span class="text-warning">BEST</span> Messenger</strong>
                            </h4>
                            <a class="btb btn-secondary p-1 rounded-5 nav-link" href="../login/login.php">
                                Go To Login Page
                            </a>
                        </div>


                        <div class="py-3 ps-container ps-theme-default ps-active-y" id="chat-content"
                             style="overflow-y: scroll !important; height:400px !important;">

                            <!--                        MESSAGES -->
                            <?php
                            for ($i = 0;
                                 $i < count($messages);
                                 $i++) {
                                /* Show my message */
                                if ($messages[$i]['sender'] === $_SESSION['user']['username']) {
                                    ?>

                                    <?php if ($messages[$i]['type'] === 'text') { ?>
                                        <!--                                my message body -->
                                        <div class="message-box media-chat media-chat-reverse d-flex flex-column">

                                            <div class="media-body text-start">
                                                <p class="message text-end" style="max-width:250px">

                                                    <?php echo $messages[$i]['content'] ?><br>

                                                    <?php if ($messages[$i]['seen']) { ?>
                                                        <i class="fa fa-check  text-white" aria-hidden="true"
                                                           style="font-size: 8px"></i>
                                                        <i class="fa fa-check  text-white" aria-hidden="true"
                                                           style="font-size: 8px"></i>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div hidden class="delete text-end mb-3">
                                            <button class="btn btn-primary btn-xs mb-1"
                                                    name="delete<?php echo $i ?>">
                                                Delete
                                            </button>
                                            <button name="edit<?php echo $i ?>" class="btn btn-primary btn-xs mb-1">
                                                edit
                                            </button>
                                            <input name="edited-content<?php echo $i ?>" type="text"
                                                   class="mx-2 w-50 d-inline form-control">
                                        </div>

                                    <?php } else if ($messages[$i]['type'] === 'image') { ?>
                                        <!--                                        if my message  image -->
                                        <div class="flex justify-content-end p-3">
                                            <div class="w-32 h-32 flex">
                                                <img src="<?php echo $messages[$i]['content'] ?>" alt="">
                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } else {
                                    $messages[$i]['seen'] = true;
                                    ?>
                                    <!--other message -->


                                    <!--                                    text -->
                                    <?php if ($messages[$i]['type'] === 'text') {
                                        ?>
                                        <div class="media media-chat <?php echo $_SESSION['user']['username'] === 'admin' ? 'message-box' : ""; ?>">
                                            <p class="text-light font-mono"><?php echo $messages[$i]['sender'] ?></p>
                                            <div class="media-body" style="max-width: 250px">
                                                <p><?php echo $messages[$i]['content'] ?></p>
                                            </div>
                                        </div>

                                        <?php if ($_SESSION['user']['username'] === 'admin') { ?>
                                            <div hidden
                                                 class="delete text-end mb-3 gap-2 flex justify-content-start mx-4 mt-1">
                                                <button class="btn btn-primary btn-xs mb-1"
                                                        name="delete<?php echo $i ?>">
                                                    Delete
                                                </button>

                                                <button class="block-user btn btn-primary btn-xs mb-1"
                                                        name="block<?php echo $i ?>">
                                                    <?php
                                                    for ($j = 0; $j < count($users); $j++) {
                                                        if ($users[$j]['username'] === $messages[$i]['sender']) {
                                                            echo $users[$j]['blocked'] ? 'unblock' : 'block';
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                </button>
                                            </div>

                                        <?php } ?>

                                    <?php } else if ($messages[$i]['type'] === 'image') { ?>
                                        <!--                                                                                if other people message is  image -->
                                        <div class="flex justify-content-start p-3 <?php echo $_SESSION['user']['username'] === 'admin' ? 'message-box' : ""; ?>">
                                            <div class="w-32 h-32 flex">
                                                <img src="<?php echo $messages[$i]['content'] ?>" alt="">
                                            </div>


                                        </div>
                                        <?php if ($_SESSION['user']['username'] === 'admin') { ?>
                                            <div hidden
                                                 class="delete mb-3 gap-2 flex justify-content-start mx-4 mt-1 gap-20">
                                                <button class="btn btn-primary btn-xs mb-1"
                                                        name="delete<?php echo $i ?>">
                                                    Delete
                                                </button>

                                                <button class="block-user btn btn-primary btn-xs mb-1"
                                                        name="block<?php echo $i ?>">
                                                    <?php echo $_SESSION['user']['blocked'] ? 'unblock user' : 'block user'; ?>
                                                </button>
                                            </div>

                                        <?php } ?>

                                    <?php } ?>
                                <?php } ?>
                            <?php }
                            file_put_contents('data.json', json_encode($messages)) ?>

                            <!--                        MESSAGE SECTION-->

                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                            </div>
                        </div>
                        <div class="publisher bt-1 border-light">
                            <div>
                                <p class="text-success" id="que">20</p>
                            </div>
                            <img class="avatar avatar-xs"
                                 src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">

                            <!--                        writing section -->
                            <input class="publisher-input" name="content" id="messageField" type="text"
                                   placeholder="Write something">

                            <!--                        upload file -->
                            <span class="publisher-btn file-group">
                        <i class="fa fa-paperclip file-browser" id="file-browser"></i>
                        <input type="file" name="file" id="file" accept=".png">
                        </span>


                            <!--                        send and emoji -->
                            <!--                        emoji -->
                            <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a>

                            <!--                        send -->
                            <button <?php echo $_SESSION['user']['blocked'] ? 'disabled' : ""; ?> name="send"
                                                                                                  class="publisher-btn text-info"
                                                                                                  id="send"><i
                                        class="fa fa-paper-plane"></i></button>


                        </div>

                    </div>
                </div>

                <!--               RIGHT CONTAINER-->
                <div class="text-start md:col-2">
                </div>
            </div>
        </div>
    </div>

</form>


<script>
    const sendMessageButton = $('#send');
    const deleteButtons = $('.delete').toArray();
    const messagesBox = $('.message-box').toArray();
    const messages = $('.message');

    console.log(deleteButtons);
    for (let i = 0; i < messagesBox.length; i++) {
        $(messagesBox[i]).on('click', function () {
            if ($(deleteButtons[i]).attr('hidden'))
                $(deleteButtons[i]).removeAttr('hidden');
            else $(deleteButtons[i]).attr('hidden', 'hidden');
        });
    }

    const messageField = $('#messageField');
    $(messageField).on('keypress', function (ev) {
        if (ev.keyCode === 13)
            return false;

    });

    const que = $('#que');
    $(messageField).on('keyup', function (e) {
        if ($(messageField).val().length > 20) {
            $(sendMessageButton).attr('disabled', 'disabled');
        } else {
            $(sendMessageButton).removeAttr('disabled');
        }

        $(que).text(20 - $(messageField).val().length);
        if (parseInt($(que).text()) < 0) {
            $(que).removeClass('text-success');
            $(que).addClass('text-danger');
        } else {
            $(que).removeClass('text-danger');
            $(que).addClass('text-success');
        }


    })

    // UPLOAD IMAGES
    $('#file-browser').on('click', function () {
        $('#file').click();
    })

</script>

</body>
</html>
