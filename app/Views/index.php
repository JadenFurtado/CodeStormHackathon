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
        <li class="nav-item">
          <a class="run btn btn-danger">Run <i class="fas fa-play"></i></a>
        </li>
        <?php if($_SESSION['filemanager']['logged']!=NULL): ?>
        <li class="nav-item">
          <a class="save btn btn-dark">Save <i class="fas fa-save"></i></a>
        </li>
        <li class="nav-item">
          <a id="debug" class="debug btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Add ' import web_pdb; web_pdb.set_trace() ' before the part of your code you want to debug">Debug <i class="fas fa-play"></i></a>
        </li>
        <li class="nav-item">
          <a class="doubt nav-link active">Doubt</a>
        </li>
        <li class="nav-item">
          <a type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Save snippet</a>
        </li>
        <li class="nav-item">
          <a class="option btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Options <i class="fas fa-cogs"></i></a>
        </li>
        <li>
          <button class="view btn btn-primary">View files <i class="far fa-file-code"></i></button>
        </li>
        <?php else:  ?>
          <a class="login btn btn-primary">Login<i class="fas fa-sign-in-alt"></i></a>
        <?php endif  ?>
      </ul>
    </div>

  <!-- Navbar links -->
  
</nav>
    <div style="padding:4px;">
      <div>
          
          
          <!-- Small modal -->
          
            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <td>
                          Snippet name
                        </td>
                        <td>
                          <input type="text" name="snippet_name" class="snippet_name">
                        </td>
                      </tr>
                      <tr>
                        <td>
                        </td>
                        <td>
                          <button class="save_snippet">Save</button>
                        </td>
                      </tr>
                    </table>                    
                  </div>
                </div>
              </div>
            </div>
            <!-- modal ends here -->
          
        
          
          <button class="full_screen btn btn-info" style="float: right"><i class="fas fa-compress"></i></button>
          <div style="float: right; padding:5px;"><?php echo $_SESSION['filemanager']['logged']; ?></div>
          <!-- options -->
          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <table>
                  <div style="padding: 5px; width: 100%;">
                    <tr>
                      <td>
                    <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                      Font Size
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item 10px" href="#">10px</a>
                      <a class="dropdown-item 13px" href="#">13px</a>
                      <a class="dropdown-item 15px" href="#">15px</a>
                      <a class="dropdown-item 18px" href="#">18px</a>
                      <a class="dropdown-item 20px" href="#">20px</a>
                      <a class="dropdown-item 22px" href="#">22px</a>
                      <a class="dropdown-item 24px" href="#">24px</a>
                     </div>
                    </div>
                    </td>
                    <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                      Themes
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item dark" href="#">Dark</a>
                        <a class="dropdown-item light" href="#">Light</a>
                      </div>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                      Python Version
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item dark" href="#">Python 2</a>
                          <a class="dropdown-item light" href="#">Python 3</a>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="padding:5px;">
                        <div><button class="btn btn-dark intellisense">Intellisense</button>
                      <label class="switch">
                        <input type="checkbox" id="intellisense" checked>
                        <span class="slider round"></span>
                      </label>
                    </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>
                      <a href='<iframe src="<?php  echo $actual_link ?>" style="width: 500px; height:500px;"></iframe>'>Copy this link to embed</a>
                    </td>
                  </tr>
              </table>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <td>
                      <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>
                      <a href='#'><xmp><iframe src="<?php  echo $actual_link ?>" style="width: 500px; height:500px;"></iframe></xmp></a>
                    </td>
                  </tr>
              </table>
              </div>
                </div>
              </div>
            </div>
            <!-- modal ends here -->
          </div>
        </div>
    <div class="wrapper">
      <div class="left_column">
        
        <div id="editor"><?php print_r($code); ?></div>
      </div>

      <!-- right column starts here -->
      <div class="right_column">
        <!-- panes -->
      <div class="row_1">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Input</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="input_field">
            <div class="inputs container">
              <textarea class="code_input"></textarea>
            </div>
          </div>
        </div>
        </div>
      </div>
      <!-- row 2 starts here -->
        <div class="row_2">
            
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="background-color: #e6e6ff;">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-home" aria-selected="true">Results</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Errors</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="results_field">
            <div class="results"><pre class="result_text" style="padding:5px;"></pre></div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="results_field">
            <div class="results"><pre class="result_text" style="padding:5px;"></pre></div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><pre class="error_text" style="padding:5px;"></pre></div>
          </div>

        </div>
      </div>
<!-- panes end here -->
      </div>
    </div>
  </div>
    <script src="app/libs/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="app/libs/ext-language_tools.js"></script>
    <script src="https://pagecdn.io/lib/ace/1.4.12/snippets/python.js" crossorigin="anonymous"></script>
<script>
    //ace editor
    ace.require("ace/ext/language_tools")
    var editor = ace.edit("editor");
    editor.resize()
    editor.setOptions({
      enableBasicAutocompletion: true,
      enableSnippets: true,
      enableLiveAutocompletion: true
    });
    editor.setTheme("ace/theme/nord_dark");
    editor.session.setMode("ace/mode/python");
   
    //run the code
    $(".run").click(function(){
      //alert($(".code_input").val());
      $.ajax({
        url: "https://localhost/code_editor/app/compiler.php",
        method: "POST",
        data:{language:"py",code:editor.getValue(),input:$(".code_input").val(),path:"<?php echo $_GET['edit']  ?>"},
        dataType:"text",
        success: function(result){
          alert(result);
          $(".result_text").text(result);
          //to change to run
          $("pills-profile-tab").click();
          $("pills-profile-tab").click();
          //$('#myTab li:last-child a').tab('show');
        },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
      });
    });
    //34 cols
    $("#debug").click(function(){
      //inject code into editor
      position={row:0,column:0};
      editor.session.insert(position,"import web_pdb;web_pdb.set_trace();");
      $.ajax({
        url: "http://localhost/code_editor/app/compiler.php",
        method: "POST",
        data:{language:"py",code:editor.getValue(),file_path:"<?php echo $_GET['edit'];?>"},
        dataType:"text",
        success: function(result){
          location.href="http://localhost:5555"
        },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
      });
    });
    //save the code
    $(".save").click(function(){
      $.ajax({
        url: "https://localhost/code_editor/save.php",
        method: "POST",
        data:{language:"py",code:editor.getValue(),file:"<?php echo $_GET['edit'] ?>",user:"<?php echo $_SESSION['filemanager']['logged'] ?>",token:"<?php echo $_COOKIE['filemanager'] ?>"},
        dataType:"text",
        success: function(result){
          alert("changes successful");
        },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
      });
    });

    //default font size
    document.getElementById('editor').style.fontSize='18px';
    $(".view").click(function(){
      <?php  if($_SESSION['filemanager']['logged']!="admin"):  ?>
        location.href="https://localhost/code_editor_1/Filemanager.php";
      <?php else:  ?>
        location.href="https://localhost/code_editor_1/admin_Filemanager.php";
      <?php endif; ?>
      });
    /*font sizes*/
    $(".10px").click(function(){
      document.getElementById('editor').style.fontSize='10px';
    });
    $(".13px").click(function(){
      document.getElementById('editor').style.fontSize='13px';
    });
    $(".15px").click(function(){
      document.getElementById('editor').style.fontSize='15px';
    });
    $(".18px").click(function(){
      document.getElementById('editor').style.fontSize='18px';
    });
    $(".20px").click(function(){
      document.getElementById('editor').style.fontSize='20px';
    });
    $(".22px").click(function(){
      document.getElementById('editor').style.fontSize='22px';
    });
    $(".24px").click(function(){
      document.getElementById('editor').style.fontSize='24px';
    });
    
    // themes //
    $(".dark").click(function(){
      editor.setTheme("ace/theme/nord_dark");
    });
    $(".light").click(function(){
      editor.setTheme("ace/theme/solarized_light");
    });
    //intellisense toggle
    if ($("#intellisense").is(":checked")) {  
      //alert("true");
      $('#intellisense').prop('checked', true);
    }
    else{
      //alert("false");
      $('#intellisense').prop('checked', false);
    }
//
    $(".intellisense").click(function(){
      //editor.enableBasicAutocompletion()=false;
    });
    $(".full_screen").click(function(){
      $(".left_column").toggleClass("full");
      $(".right_column").toggleClass("none");
    });
    /* full screen
    $(".full_screen").click(function(){
      $(".left_column").css({"width":"100%"});
      $(".right_column").css({"width":"0%","display":"none"});
      $("full_screen").css({"display":"none"});
      $(".norm_screen").css({"display":"contents"})
    });
    $(".norm_screen").click(function(){
      $(".left_column").css({"width":"50%"});
      $(".right_column").css({"width":"50%","display":"contents"});
      $("norm_screen").css({"display":"none"});
      $("full_screen").css({"display":"contents"});
    });
    */
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
// function to save snippet 


$(".save_snippet").click(function(){
  var snippet_name = $(".snippet_name").val();
  var snippet_code = editor.getValue();
    $.ajax({
    url: "https://localhost/code_editor_1/public/Snippet/save_snippet",
    method: "POST",
    data:{language:"py",code:editor.getSelectedText(),student_name:"<?php echo $_SESSION['filemanager']['logged'] ?>",snippet_name:snippet_name},
    dataType:"text",
    success: function(result){
      alert("changes successful");
    },
    error: function(jqxhr, status, exception) {
      alert('Exception:', exception);
    }
  });
});
//login
$(".login").click(function(){
  location.href="https://localhost/code_editor_1/login.php"
});

$(".doubt").click(function(){
  location.href="http://localhost/code_editor_1/public/Doubts";
});
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