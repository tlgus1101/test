<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
if (mysqli_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_error($con);
}

if ($_POST['page'] == "write_board") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $pw = $_POST['pw'];

    $sql = "Insert Into test.board (id,title,contnet,pw,date) values('$id','$title','$content','$pw',NOW());";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else "1 record added";
    echo "<script type='text/javascript'>
		window.opener.location.reload('board_list.php');
		window.close();
		</script>";

}
// $sql_page = mysql_query("select * from test.board order by idx desc limit $pageing,$lmt",$con);
// $list = mysql_num_rows($sql_page);
mysqli_close($con);
?>



