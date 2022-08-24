<html>
<form method="post" enctype="multipart/form-data">
    <div class="card card-bordered rounded-4">

        <div class="card-header bg-primary">
            <h4 class="card-title"><strong><span class="text-warning">BEST</span> Messenger</strong>
            </h4>
            <a class="btb btn-secondary p-1 rounded-5 nav-link" href="../login/login.php">
                Go To Login Page
            </a>
        </div>


        <!--                    MAIN CONTAINER -->
        <div class="ps-container ps-theme-default ps-active-y" id="chat-content"
             style="overflow-y: scroll !important; height:400px !important;">

            <?php
            for ($i = 0;
            $i < count($messages);
            $i++) {
            if ($messages[$i]['sender'] === $_SESSION['user']['username']) { ?>
            <!--                        ME-->
            <div class="message-box media-chat media-chat-reverse d-flex">

                <div class="media-body text-start">

                    <p class="message">

                        <?php echo $messages[$i]['content'] ?><br>

                        <?php if ($messages[$i]['seen']) { ?>
                            <i class="fa fa-check  text-white" aria-hidden="true"
                               style="font-size: 8px"></i>
                            <i class="fa fa-check  text-white" aria-hidden="true"
                               style="font-size: 8px"></i>
                        <?php } ?>
                    </p>
                    <div hidden class="delete text-end mb-3">
                        <button class="btn btn-primary btn-xs mb-1" name="delete<?php echo $i ?>">
                            Delete
                        </button>
                        <button name="edit<?php echo $i ?>" class="btn btn-primary btn-xs mb-1">edit
                        </button>
                        <input name="edited-content<?php echo $i ?>" type="text"
                               class="mx-2 w-50 d-inline form-control">
                    </div>
                    <?php } ?>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</form>
</html>
