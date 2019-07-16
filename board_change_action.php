<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
if (mysqli_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_error($con);
}
$idx = $_POST["idx"];
$title = $_POST["title"];
$content = $_POST["content"];
$password = $_POST['pw'];

$sql = "select * from test.board where idx=$idx AND  pw='$password';";
$result = mysqli_query($con, $sql);
//print_r($result);
//$data = $mysqli_fetch_array($result);
//echo "<script> alert($data);</script>";
if (mysqli_num_rows($result) != 0) {
    $sql = "update test.board set title='$title' , contnet='$content' where idx=$idx;";
    if (mysqli_query($con, $sql)) {
        echo "<script> alert('수정되었습니다.'); this.document.location.href = 'board_detail.php?idx=$idx';   </script>";
    } else {
        echo "ERRor " . $sql . "" . mysqli_error($con);
    }
} else {
    echo "<script> alert('비밀번호가 틀렸습니다.'); history.go(-1);  </script>";
}
?>






