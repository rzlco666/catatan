<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notes</title>
        <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-4.1.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <script src="<?= base_url() ?>assets/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>assets/bootstrap-4.1.1/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
        <script>base_url = "<?= base_url() ?>"</script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/main.js"></script>
    </head>
    <body>
        <!--BEGIN NAVBAR-->
        <div class="container-fluid max-width">
            <nav class="navbar navbar-expand-lg navbar-light bg_red text-white">
                <a class="navbar-brand text-white" href="#">Notes</a>
                <a class="navbar-brand text-white" href="#"><?php echo $this->session->userdata('email'); ?></a>
                <a class="navbar-brand text-white" href="<?= base_url() ?>login/logout">Logout</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search">
                        <!-- <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button> -->
                    </form>
                </div>
            </nav>
        </div>
        <!--END NAVBAR-->
        <!--BEGIN NOTES-->
        <div class="container">
            <div class="row mb_10 mt_10">
                <div class="col-sm-8 center">
                    <div class="card insert_note_card">
                        <div id="insert_note" class="card-body light_gray">
                            Take a note...
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 notes">
                    <?php
                    $i=0;
                    foreach ($notes as $note){
                        $i++;
                        if($i==1){
                            ?>
                    <div class="row mb_10 mt_10">
                    <?php
                        }
                        ?>
                    <div class="col-sm-3">
                        <div class="card full-height note" data-id="<?=$note->id?>">
                            <div class="card-body">
                              <span title="Delete Note" class="delete float-right text-danger" data-id="<?=$note->id?>"><i class="fa fa-trash"></i></span>
                                <h5 class="card-title"><?=$note->title?></h5>
                                <p class="card-text"><?=$note->text?></p>
                            </div>

                        </div>
                    </div>

                        <?php if($i==4){
                             $i=0;
                            ?>
                    </div>
                        <?php
                        }
                        ?>

                    <?php } ?>
                </div>
            </div>
        </div>
        <!--END NOTES-->
        <!-- BEGIN MODAL -->
        <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <span title="Delete Note" id="modal-delete" class="modal-delete text-danger" data-id="<?=$note->id?>"><i class="fa fa-trash"></i></span>
          &nbsp;  <span id="modal-saving" class="text-gray"></span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <h4 id="modal-title" contenteditable="true"></h4>
        <div id="modal-text" contenteditable="true">

        </div>
        </div>
      </div>
    </div>
  </div>
        <!-- END MODAL -->
    </body>
</html>
