<?php
include('config.php');

    function showimg($s) {
        echo htmlspecialchars($s);
    }
    
	$sql = "SELECT * FROM imagedata";
    $result = mysqli_query($conn,$sql);
?>

<?php if (mysqli_num_rows($result)==0) { ?>
    Database is empty <br/>
<?php } else { ?>

 <table border="1" style="border: 1px solid black; border-collapse: collapse; margin-left: 323px;margin-top: 44px; width:50%">
        <tr>
		    <th style="background-color: grey;">ID</th>
            <th style="background-color: grey;">Form ID</th>
            <th style="background-color: grey;">Image</th>
            <th style="background-color: grey;">Date</th>
        </tr>
        <?php while ($row= mysqli_fetch_assoc($result)) { ?>
            <tr>
			    <td style="text-align: center;"><?php showimg($row['id']); ?></td>
                <td style="text-align: center;"><?php showimg($row['form_id']); ?></td>
                <td style="text-align: center;">
                    <a href="/Image_Compression/<?php showimg($row['image']); ?>">
                        <img src="/Image_Compression/<?php showimg($row['image']); ?>" width="250" height="250"/>
                    </a>
                </td>
				 <td style="text-align: center;"><?php showimg($row['date']); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php  } ?>
