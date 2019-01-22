

<?php
//continets array
$continets = array(
    "na"=>"North America",
    "sa"=>"South America",
    "eu"=>"Europe",
    "as"=>"Asia",
    "au"=>"Australia",
    "af"=>"Africa",
    "an"=>"Antarctica"
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
        <!--week03 team activity-->

        <div class="content" >
            <table>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['nameTxb']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <a href="mailto:<?php echo $_POST['emailTxb']; ?>" target="_blank">
                         <?php echo $_POST['emailTxb']; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Major</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['major']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Comments</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['comments']; ?></span>
                    </td>
                </tr>
            </table>
            <br/><br/>
            <label>Continets that you have visited</label><br/>
            <p>
                <?php
                    foreach($_POST['continets'] as $selected)
                    {
                        echo $continets[$selected]."<br/>";
                    }

                ?>
            </p>

        </div>

        <script>


        </script>
    </body>
</html>



