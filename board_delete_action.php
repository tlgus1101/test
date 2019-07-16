<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
if (mysqli_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_error($con);
}
$idx = $_GET['idx'];
if ($_POST['pw']) {
    $idx = $_POST['idx'];
    $pw = $_POST['pw'];
    $sql = "select * from test.board where idx=$idx AND  pw='$pw';";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) != 0) {
        $sql = "delete from  test.board  where idx=$idx;";
        if (mysqli_query($con, $sql)) {
            echo "<script type='text/javascript'>
                alert('삭제 되었습니다.');
		window.close();
		window.opener.location.href='board_list.php';
               // window.close();
                </script>";
        } else {
            echo "ERRor " . $sql . "" . mysqli_error($con);
        }
    } else {
        echo "<script> alert('비밀번호가 틀렸습니다.'); </script>";
    }

}

?>

<html>
<head><title>삭제</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<form method='post'>
    <table class='table'>
        <tr>
            <td>비밀번호를 입력해 주세요.
            <td>
        </tr>
        <tr>
            <td><input type='hidden' id='idx' name='idx' value='<?php echo $_GET['idx']; ?>'><input type='text' id='pw'
                                                                                                    name='pw'></td>
        <tr>
    </table>
    <div align=center>
        <button class='btn btn-outline-primary'>삭제</button>
    </div>
    <form>
</body>
</html>






