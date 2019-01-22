

<?php

$majorArray = array(
    "CS"=>"Computer Science",
    "WDD"=>"Web Design and Development",
    "CIT"=>"Computer information Technology",
    "CE"=>"Computer Engineering"
);


?>

<!DOCTYPE HTML>

<html lang="en" >
    <head>
	<meta charset="utf-8" />
        <title>week03 team act</title>
        <style type="text/css">

        </style>    
    </head>
    <body>

        <div class="content" >
            <form id="week03Form" action="process.php" method="post" >
                <table>
                    <tr>
                        <td>
                            <label for="nameTxb">Name</label>
                        </td>
                        <td>
                            <input type="text" id="nameTxb" name="nameTxb"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="emailTxb">Email</label>
                        </td>
                        <td>
                            <input type="text" id="emailTxb" name="emailTxb"/>
                        </td>
                    </tr>
                
                </table>
                <br/>
                <label>Major</label><br/>
               <!-- <input type="radio" name="major" value="Computer Science" /> Computer Science <br/>
                <input type="radio" name="major" value="Web Design and Development" /> Web Design and Development <br/>
                <input type="radio" name="major" value="Computer information Technology" /> Computer information Technology <br/>
                <input type="radio" name="major" value="Computer Engineering" /> Computer Engineering <br/>-->
                <?php
                    foreach($majorArray as $major)
                    {
                        echo "<input type='radio' name='major' value='".$major."'/>".$major."<br/>";

                    }
                ?>
                <br/><br/>
                
                <label>Comments</label><br/>
                <textarea name="comments"></textarea>

                <br/><br/>
                <label>Continets that you have visited</label><br/>
                <input type="checkbox" name="continets[]" value="na" />North America <br/>
                <input type="checkbox" name="continets[]" value="sa" />South America <br/>
                <input type="checkbox" name="continets[]" value="eu" />Europe <br/>
                <input type="checkbox" name="continets[]" value="as" />Asia <br/>
                <input type="checkbox" name="continets[]" value="af" />Africa <br/>
                <input type="checkbox" name="continets[]" value="an" />Antarctica <br/>
                <input type="checkbox" name="continets[]" value="au" />Australia <br/>

                <br/><br/>
                <input type="submit" value="submit" />
                
            
            </form>
        </div>

        <script>


        </script>
    </body>
</html>



