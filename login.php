<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    body{
      padding: 5px;
      background-color:  #ffe6e6;
    }
    .wrapper{
      width: 100%;
      height: 100%;
      padding: 5px;
    }
    
    #editor { 
        position: relative;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        height:90vh;
        width: 100%;
    }
    /* column structure */
    .left_column{
      width: 50%;
      float:  left;
    }
    .right_column{
      width: 50%;
      float: right;
      padding: 5px;
    }
    /* right column containers */
    .input_field{
      width: 100%;
      height: 40vh;
    }
    .inputs{
      height: 80%;
    }
    .result_text{
      overflow: auto;

    }
textarea {
    width: 100%;
    height: 100%;
}
    .results_field{
      width: 100%;
      height: 40vh;
      color: black;
      padding: 15px;
    }
    .results{
      padding: 5px;
     border: 1px solid black;
     height: 70%; 
     overflow: auto;
    }
    /* rows */
    .row_1{
      height: 50%;
      background-color: #e6e6ff;
    }
    .row-2{
      height: 50%;
      background-color: #e6e6ff;
    }
    /* for the full screen toggle */
.norm_screen{
  display: none;
}
  /* for sliders */
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.full{
  width: 100%;
}

.none{
  display: none;
  width: 0%;
}

    </style>
   <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- google jquery -->
    <title>Code Editor</title>
    <!-- brython -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/brython/3.9.5/brython.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/brython/3.9.5/brython_stdlib.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/pythonpad/brython-runner/lib/brython-runner.bundle.js"></script>
  <!-- ui js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#006666">
  <!-- Brand -->
    <a class="navbar-brand" href="#">Code Editor</a>

  <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
    </div>

  <!-- Navbar links -->
  
</nav>
  <div>
    <button class="btn btn-dark" id="admin">Login as Admin</button>
    <button class="btn btn-light" id="student">Login as Student</button>
  </div>
  <script type="text/javascript">
    $("#admin").click(function(){
      location.href="http://localhost/code_editor_1/admin_File_manager.php";
    });
    $("#student").click(function(){
      location.href="http://localhost/code_editor_1/Filemanager.php";
    })
  </script>
    <!-- Optional JavaScript; choose one of the two! -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </body>
</html>