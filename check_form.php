<?php
if(isset($_POST['codpostal_formular'])){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.coduriro.ro/api.php/authenticate/" . $_POST['uid2'] . '/' .$_POST['uid1']);
    curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   
    curl_setopt($ch, CURLOPT_COOKIESESSION, true );
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt' );
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt' );
    
    // Fetch and return content, save it.
    $raw_data1 = curl_exec($ch);
    curl_close($ch);
    
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://api.coduriro.ro/api.php/getCod/" . $_POST['codpostal_judet'] . '/' .$_POST['codpostal_localitate'] . '/' .$_POST['codpostal_strada']);
    curl_setopt($ch1, CURLOPT_HEADER, 0);            // No header in the result 
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   
    curl_setopt($ch1, CURLOPT_COOKIESESSION, true );
    curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookie.txt' );
    curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookie.txt' );
    // Fetch and return content, save it.
    $raw_data = curl_exec($ch1);
    curl_close($ch1);

    // If the API is JSON, use json_decode.
    $data = json_decode($raw_data);
    ?>
    <table>
    <?php
    if(count($data)){
        foreach($data as $k=>$value){
            ?>
            <tr>
                <td><?php echo $value->judet; ?>, <?php echo $value->localitate; ?>, <?php echo $value->strada; ?><br /><?php echo $value->cod; ?></td>
            </tr>
            <?php
        }
    }
    else{
        echo 'Niciun rezultat!';
    }
    ?>
    </table>
    <?php
}
if(isset($_POST['codpostal_formular_addr'])){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.coduriro.ro/api.php/authenticate/" . $_POST['uid2'] . '/' .$_POST['uid1']);
    curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   
    curl_setopt($ch, CURLOPT_COOKIESESSION, true );
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt' );
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt' );
    
    // Fetch and return content, save it.
    $raw_data1 = curl_exec($ch);
    curl_close($ch);
    
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://api.coduriro.ro/api.php/getAdresa/" . $_POST['codpostal_cod']);
    curl_setopt($ch1, CURLOPT_HEADER, 0);            // No header in the result 
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   
    curl_setopt($ch1, CURLOPT_COOKIESESSION, true );
    curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookie.txt' );
    curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookie.txt' );
    // Fetch and return content, save it.
    $raw_data = curl_exec($ch1);
    curl_close($ch1);

    // If the API is JSON, use json_decode.
    $data = json_decode($raw_data);
    ?>
    <table>
    <?php
    if(count($data)){
        foreach($data as $k=>$value){
            ?>
            <tr>
                <td><?php echo $value->judet; ?>, <?php echo $value->localitate; ?>, <?php echo $value->strada; ?><br /><?php echo $value->cod; ?></td>
            </tr>
            <?php
        }
    }
    else{
        echo 'Niciun rezultat!';
    }
    ?>
    </table>
    <?php
}
?>
