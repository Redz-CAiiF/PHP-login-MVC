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
    
    <link rel="stylesheet" href="css/generalstyles.css"><!-- block-selection-->
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
    <form action="index.php?controller=RegisterController" method="post" style="padding-right:5vw; padding-left:5vw;">
    <div class="container row-containment bg-color radius30px block-selection padding" style="margin-top: 5vh; margin-bottom: 5vh; max-width:650px;">
      <div class="row mx-auto text-center">
          <div class="col form-title">
              Crea profilo
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Name">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-name" name="user-name" placeholder="Name"> <!-- invalid to display wrong data input -->
              </div>
          </div>
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Surname">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-surname" name="user-surname" placeholder="Surname"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <div class="input-group mb-2 txt-dark m-t-10" field="Email">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><i class="fas fa-at flat-icon"></i></div>
                </div>
                <input type="email" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-email" name="user-email" placeholder="Email"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Username">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-username" name="user-username" placeholder="Username"> <!-- invalid to display wrong data input -->
              </div>
          </div>
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Password">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-key flat-icon"></label></div>
                </div>
                <input type="password" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-password" name="user-password" placeholder="Password"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6">
            <div class="input-group mb-2 txt-dark m-t-10" field="Region">
              <div class="input-group-prepend">
                <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-map flat-icon"></label></div>
              </div>
              <input type="select" name="user-region" id="md-select-input" class="hidden validate">
              <div class="md-select form-control radius-0 bg-none border-none border-bottom focused">
                <label>Region</label>
                <ul role="listbox" class="md-whiteframe-z1">
                  <?php
                  if(isset($provincie)){
                    foreach($provincie as $row){
                      echo '<li>'.$row->nomeProvincia.'</li>';
                    }
                  }
                  ?>
                </ul>
              </div><!-- invalid to display wrong data input -->
            </div>
          </div>
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Address">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-map-marker-alt flat-icon"></label></div>
                </div>
                <input type="address" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-address" name="user-address" placeholder="Address" data-toggle="tooltip" data-placement="bottom" title="via nomeVia, numero"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6">
            <div class="input-group mb-2 txt-dark m-t-10" field="Birthdate">
              <div class="input-group-prepend">
                <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-calendar-alt flat-icon"></label></div>
              </div>
              <input type="date" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="user-birthdate" name="user-birthdate" placeholder="Birthdate"> <!-- invalid to display wrong data input -->
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="input-group mb-2 txt-dark m-t-10" field="Picture">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fa fa-folder flat-icon"></label></div>
                </div>
                <input type="file" class="custom-file-input validate" id="user-picture" name="user-picture">
                <label id="user-picture-label" class="custom-file-label form-control radius-0 bg-none border-none border-bottom focused hide-overflow" for="user-picture">Choose file</label> <!-- invalid to display wrong data input -->
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
        <button type="submit" name="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50" id="startValidate">Create profile</button>
      </div>
    </div>
    </form>
    <div style="width: 25px; height: 25px;" class="mx-auto">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 310.8 310.8"><path fill="#be1e37" d="M305.1 229.1l-119-186.5c-6.7-10.5-18.2-16.8-30.7-16.8s-23.9 6.3-30.7 16.8L5.7 229.1c-7.1 11.2-7.6 25.4-1.2 37 6.4 11.6 18.6 18.9 31.9 18.9h238.1c13.3 0 25.5-7.2 31.9-18.9 6.3-11.6 5.8-25.8-1.3-37zm-149.7 24.5c-10.9 0-19.8-8.9-19.8-19.8s8.9-19.8 19.8-19.8 19.8 8.9 19.8 19.8c0 11-8.9 19.8-19.8 19.8zm27.5-137.7l-9.8 65.7c-1.4 9.7-10.4 16.4-20.1 14.9-7.8-1.2-13.7-7.3-14.9-14.7l-10.6-65.6c-2.5-15.3 7.9-29.7 23.2-32.1s29.7 7.9 32.1 23.2c.5 2.9.5 5.9.1 8.6z"></path></svg>
    </div>
    <!-- end content -->
    <script type="text/javascript">
      $("form").submit(function( event ) {
        $(".validate").each(function(){ validateField($(this)); });
      });
    </script>
  </body>
</html>