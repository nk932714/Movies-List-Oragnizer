<?php
      /***************   some Universal Constants here           **********************/
     /*************/     $script_name = "Movies Organizer";      /********************/
    /*************/      $site_name = "";            /*******************/
   /*************/       $site_link = "";     /******************/
  /**************        END OF UNIVERSAL CONSTANTS              ******************/
$full_url = $_SERVER['REQUEST_URI']; $qurey_url = '?'.$_SERVER['QUERY_STRING']; $full_url1 = str_replace($qurey_url,'', $full_url);
$whomtosent     = $_POST["word"];
$whomtosents    = preg_replace('/\s+/', '', $whomtosent);
                  $deleteORadd= $_POST["way"];
                  $whereToDelete = $_POST["dir"];
                  if (empty($whomtosents)) { $delete_word =''; } else { $delete_word = '<li>'.$whomtosent.'</li>'; }
                  //$delete_word = '<li>'.$whomtosent.'</li>';
?>
<html>
<head>
      <title><?php echo $script_name; ?></title>
      <link href="style2.css" rel="stylesheet" type="text/css" />
      <link href="style.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  <!-- for autocomplete below lines -->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <?php             /* this php code will get all suggestion words from the txt file */
              $file1 = 'deleted.txt'; $file2 = 'dual.txt'; $file3 = 'eng.txt'; $file4 = 'hin.txt'; $file5 = 'new.txt'; $file6 = 'other.txt'; $file7 = 'pun.txt'; 
              $value1 = file_get_contents($file1);    $value2 = file_get_contents($file2);    $value3 = file_get_contents($file3);    $value4 = file_get_contents($file4);    $value5 = file_get_contents($file5);    $value6 = file_get_contents($file6);    $value7 = file_get_contents($file7);
              $historyy = $value1.$value2.$value3.$value4.$value5.$value6.$value7;
              $re_suggestions = '/<li>(.*?)<\/li>/m';
              preg_match_all($re_suggestions , $historyy, $matches_suggestion);
              $suggestions_list = '"'.implode('","',$matches_suggestion[1]).'"';
      ?>
      <script>
        $( function() {
          var availableTags = [
            <?php echo $suggestions_list; ?>
                              ];
            $( "#tags" ).autocomplete({
            source: availableTags
                                });
               } );
      </script>
  <!-- for autocomplete above -->
      <script type="text/javascript" src="script.js"></script>
      <style> .inline {     display: inline-block;     } </style>  <!--behind for style of lola tag text --> <style> lola {    color: red;    margin-left: 40px; } </style>
      <style> #deleted li::before { content: "Deleted -"; color: brown; } #dual li::before { content: "Dual Audio -"; color: brown; } #eng li::before { content: "English -"; color: brown; } #hin li::before { content: "Hindi -"; color: brown; } #new li::before { content: "NEW -"; color: brown; } #other li::before { content: "Other Language -"; color: brown; } #pun li::before { content: "Punjabi -"; color: brown; } </style>
      <style> .pup:link, .pup:visited { background-color: #f4511e; color: white; padding: 4px 6px; text-align: center; text-decoration: none; display: inline-block; } .pup:hover, .pup:active { background-color: red; } </style>
      <style>       .button2 { display: inline-block; border-radius: 6px; background-color: #f4511e; border: none; color: #FFFFFF; text-align: center; font-size: 15px; padding: 5px; width: 120px; transition: all 0.5s; cursor: pointer; margin: 5px; } .button2 span { cursor: pointer; display: inline-block; position: relative; transition: 0.5s; } .button2 span:after { content: '\00bb'; position: absolute; opacity: 0; top: 0; right: -20px; transition: 0.5s; } .button2:hover span { padding-right: 25px; } .button2:hover span:after { opacity: 1; right: 0; } input[type=text1] { width: 130px; box-sizing: border-box; border: 5px solid #ccc; border-radius: 19px; font-size: 15px; padding: 12px 10px 12px 10px; -webkit-transition: width 0.4s ease-in-out; transition: width 0.4s ease-in-out; } input[type=text1]:focus { width: 30%; }      </style>
      <style> .ol { display: block; list-style-type: decimal; margin-top: 0em; margin-bottom: 1em; margin-left: 0; margin-right: 0; padding-left: 40px; } </style>
</head>
<body>
                            <form method="post" action="<?php  echo $PHP_SELF; ?>">
                            <select name="way" required> <option value="" selected="selected">Please Select</option> <option value="add">Add New Entry</option> <option value="del">Delete Entry</option>  </select>
                            <select name="dir" required> <option value="" selected="selected">Please Select</option> <option value="dual">Dual Audio</option> <option value="eng">English Audio</option> <option value="hin">Hindi</option> <option value="new">New</option> <option value="other">Other Lang</option> <option value="pun">Punjabi</option> <option value="deletee">Deleted</option></select>
                            <input type="text1" id="tags" class="text1" maxlength="9999999999" name="word" placeholder="Word to delete from list"><br>
                            <input type="submit" name="submit" class="button2" value="submit"><br>
                            <a class=pup href="./">Go Back</a>
                            </form><button onclick="sortListDir()">Sort</button>&nbsp;<a class=pup href="<?php echo $full_url1; ?>">Click Refreash</a>&nbsp;<a class=pup href="#bottom" id="hulk">Click to go to Bottom</a>

<?php
              $history = '<ol id="deleted" start="1">'.$value1.'</ol><ol id="dual" start="1">'.$value2.'</ol><ol id="eng" start="1">'.$value3.'</ol><ol id="hin" start="1">'.$value4.'</ol><ol id="new" start="1">'.$value5.'</ol><ol id="other" start="1">'.$value6.'</ol><ol id="pun" start="1">'.$value7.'</ol>';


                  switch ($deleteORadd) {
                                         case "add":
                                                 switch ($whereToDelete) {

                                                                          case "deletee":
                                                                          $enter_data = $value1.$delete_word; file_put_contents("deleted.txt",$enter_data); echo '<ol id="deleted" start="1"><br><lola>Your new List of Deleted Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "dual":
                                                                          $enter_data = $value2.$delete_word; file_put_contents("dual.txt",$enter_data); echo '<ol id="dual" start="1"><br><lola>Your new List of Dual Audio Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "eng":
                                                                          $enter_data = $value3.$delete_word; file_put_contents("eng.txt",$enter_data); echo '<ol id="eng" start="1"><br><lola>Your new List of English Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "hin":
                                                                          $enter_data = $value4.$delete_word; file_put_contents("hin.txt",$enter_data); echo '<ol id="hin" start="1"><br><lola>Your new List of Hindi Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "new":
                                                                          $enter_data = $value5.$delete_word; file_put_contents("new.txt",$enter_data); echo '<ol id="new" start="1"><br><lola>Your new List of New Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "other":
                                                                          $enter_data = $value6.$delete_word; file_put_contents("other.txt",$enter_data); echo '<ol id="other" start="1"><lola><br>Your new List of Other Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "pun":
                                                                          $enter_data = $value7.$delete_word; file_put_contents("pun.txt",$enter_data); echo '<ol id="pun" start="1"><br><lola>Your new List of Punjabi Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          default:
                                                                          echo "Please Select any Value where to add this query";
                                                                          break;
                                                                         }
                                         break;
                                         case "del":
                                                 switch ($whereToDelete) {
                                                                          case "deletee":
                                                                          $enter_data = str_replace($delete_word ,'',$value1); file_put_contents("deleted.txt",$enter_data); echo '<ol id="deleted" start="1"><br><lola>Your new List of Deleted Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "dual":
                                                                          $enter_data = str_replace($delete_word ,'',$value2); file_put_contents("dual.txt",$enter_data); echo '<ol id="dual" start="1"><br><lola>Your new List of Dual Audio Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "eng":
                                                                          $enter_data = str_replace($delete_word ,'',$value3); file_put_contents("eng.txt",$enter_data); echo '<ol id="eng" start="1"><br><lola>Your new List of English Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "hin":
                                                                          $enter_data = str_replace($delete_word ,'',$value4); file_put_contents("hin.txt",$enter_data); echo '<ol id="hin" start="1"><br><lola>Your new List of Hindi Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "new":
                                                                          $enter_data = str_replace($delete_word ,'',$value5); file_put_contents("new.txt",$enter_data); echo '<ol id="new" start="1"><br><lola>Your new List of New Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "other":
                                                                          $enter_data = str_replace($delete_word ,'',$value6); file_put_contents("other.txt",$enter_data); echo '<ol id="other" start="1"><br><lola>Your new List of Other Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          case "pun":
                                                                          $enter_data = str_replace($delete_word ,'',$value7); file_put_contents("pun.txt",$enter_data); echo '<ol id="pun" start="1"><br><lola>Your new List of Punjabi Movies is given below. Please click refresh to view all movies list.</lola><br><br><br>'.$enter_data;
                                                                          break;
                                                                          default:
                                                                          echo "Please Select any Value from where to Delete this query";
                                                                          break;
                                                                         }
                                        break;
                                        default:
                                               echo $history;
                                                break;
 }




?>
<a class=pup href="#top" id="hulk">Click to go to Top</a>
 <script type="text/javascript" src="jquery.js"></script>
 <script> function sortListDir() { var list, i, switching, b, shouldSwitch, dir, switchcount = 0; list = document.getElementById("id01"); switching = true; /*Set the sorting direction to ascending:*/ dir = "asc"; /*Make a loop that will continue until no switching has been done:*/ while (switching) { /*start by saying: no switching is done:*/ switching = false; b = list.getElementsByTagName("LI"); /*Loop through all list-items:*/ for (i = 0; i < (b.length - 1); i++) { /*start by saying there should be no switching:*/ shouldSwitch = false; /*check if the next item should switch place with the current item, based on the sorting direction (asc or desc):*/ if (dir == "asc") { if (b[i].innerHTML.toLowerCase() > b[i + 1].innerHTML.toLowerCase()) { /*if next item is alphabetically lower than current item, mark as a switch and break the loop:*/ shouldSwitch = true; break; } } else if (dir == "desc") { if (b[i].innerHTML.toLowerCase() < b[i + 1].innerHTML.toLowerCase()) { /*if next item is alphabetically higher than current item, mark as a switch and break the loop:*/ shouldSwitch= true; break; } } } if (shouldSwitch) { /*If a switch has been marked, make the switch and mark that a switch has been done:*/ b[i].parentNode.insertBefore(b[i + 1], b[i]); switching = true; /*Each time a switch is done, increase switchcount by 1:*/ switchcount ++; } else { /*If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.*/ if (switchcount == 0 && dir == "asc") { dir = "desc"; switching = true; } } } } </script>
 <script type="text/javascript" src="jquery.js"></script>
</body></html>
