<?php
/*キャッシュ(ページ)の期限切れを向こうにさせる*/
session_cache_limiter("none");
/*SESSIONをPHPでStartさせるとブラウザーのキャッシュが利用できないため、期限切れとなる*/
session_start();
require_once 'sql.php';

$id_code = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(!empty($_POST['id'])){
            $id_code = $_POST['id'];
        }
    }
    $user = new search_id($id_code,'password');
    $show = $user->moneyCheck();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>moneyManage</title>
    </head>
    <body>
        <h2>MoneyManage</h2>
        <form action="money_in.php" method="post">
            <table border="1">
                <th>ID</th><th>salary</th><th>saving</th><th>out_money</th>
                <th>product</th><th>date</th>
                <?php
                foreach($show as $value){ ?>
                    <tr>
                        <td><?php echo $value['id_code'];   ?></td>
                        <td><?php echo $value['salary'];    ?></td>
                        <td><?php echo $value['saving'];    ?></td>
                        <td><?php echo $value['out_money']; ?></td>
                        <td><?php echo $value['product'];   ?></td>
                        <td><?php echo $value['day'];      ?></td>
                    </tr>
          <?php } ?>
            </table>
            <input type="hidden" name="id" value="<?php echo $id_code; ?>">
            <input type="hidden" name="saving" value="<?php echo $value['saving']; ?>" >
            <input type="submit" name="money_in" value="MoneyIN_OUT">
        </form>
        <form action="life.php" method="post">
            <input type="hidden" name="id" value="<?php echo $value['id_code']; ?>">
            <input type="hidden" name="flag" value="1">
            <input type="submit" value="Back">
        </form>
        <form action="login.html" method="post">
            <input type="submit" value="TOP-PAGE">
        </form>
    </body>
</html>
