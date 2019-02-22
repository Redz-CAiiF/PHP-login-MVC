<!doctype html>
<html lang="en">
  <head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- jQuery -->
    <script src="Components/jquery/3.3.1/js/jquery.js"></script>
    <script src="Components/jquery/3.3.1/js/jqueryPlus.js"></script>

    <!-- Popper -->
    <script src="Components/popper/js/popper.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Components/bootstrap/4.2/css/bootstrap.css">
    <script src="Components/bootstrap/4.2/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="../../css/generalstyles.css"><!-- block-selection-->
    <link rel="stylesheet" href="css/stilicondivisi.css">
    <link rel="stylesheet" href="css/util.css">
    
    <link rel="stylesheet" href="Components/fontAWESOME/css/all.css">
    
    <!-- minimal Framework -->
    <link rel="stylesheet" href="Components/minimal/css/minimal.css">
    <script type="text/javascript" src="Components/minimal/js/minimal.js"></script>
    <!-- scrollbar -->
    <link rel="stylesheet" href="Components/customScrollbar/css/customScrollbar.css">
    <!-- radio -->
    <link rel="stylesheet" href="Components/radio/css/radio.css">
    <!-- file -->
    <link rel="stylesheet" href="Components/file/css/file.css">
    <!-- waves -->
    <link rel="stylesheet" href="Components/waves/css/waves.css">
    <script src="Components/waves/js/waves.js"></script>
    <!-- customSelect -->
    <link rel="stylesheet" href="Components/customSelect/css/customSelect.css">
    <script src="Components/customSelect/js/customSelect.js"></script>
    <!-- POPUP -->
    <link rel="stylesheet" type="text/css" href="Components/popup/css/popup.css">
    <script src="Components/popup/js/popup.js"></script>
  </head>
  <body>
    <?php
      if(isset($popup) && $popup != ""){
        echo("<div id='overlay' onclick='closePopup();'><div id='text'>".$popup."</div></div>");
      }
    ?>
    <div class="block"></div>
    <div class="container row-containment bg-color radius30px block-selection padding" style="margin-top: 5vh; margin-bottom: 5vh; max-width:500px;">
      <div class="row mx-auto text-center">
          <div class="col form-title">
              Log in
          </div>
      </div>
      <form id="loginForm" action="index.php?controller=LoginController" method="post">
      <div class="row">
          <div class="col">
              <div class="input-group mb-2 txt-dark m-t-10" field="Username">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-username" name="user-username" placeholder="Username"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <div class="input-group mb-2 txt-dark m-t-10" field="Password">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-key flat-icon"></label></div>
                </div>
                <input type="password" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-password" name="user-password" placeholder="Password"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col">
            <div class="mx-auto" style="width: 75px;">
              <label>
                <input name="chosenDB" id="pdo" type="radio" value="pdo" checked /> <span>PDO</span>
              </label>
            </div>
          </div>
          <div class="col">
            <div class="mx-auto" style="width: 75px;">
              <label>
                <input name="chosenDB" id="msqli" type="radio" value="msqli" /> <span>MSQLi</span>
              </label>
            </div>
          </div>
      </div>
      <div class="row btn-color-cyan btn-txt-color-light btn-txt-color-light-hover">
        <button type="submit" name="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50" id="startValidate">Log in</button>
      </div>
      </form>
      <div class="row">
        <form action="index.php?controller=RegisterController" method="post" class="centered">
          <button type="submit" class="text-center link" style="background-color: transparent; border: none;">not a member yet.</button>
        </form>
      </div>
    </div>
    <!-- end content -->
    <script type="text/javascript">
      $("#loginForm").submit(function( event ) {
        $(".validate").each(function(){ validateField($(this)); });
      });
    </script>
  </body>
</html>