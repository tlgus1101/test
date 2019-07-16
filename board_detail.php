<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
if (mysqli_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_error($con);
}

$query = "SELECT * FROM test.board where idx=" . $_GET['idx'];
if ($result = mysqli_query($con, $query)) {
    $str = "";
    while ($data = mysqli_fetch_array($result)) {
        $idx = $data['idx'];
        $id = $data["id"];
        $title = $data["title"];
        $date = $data["date"];
        $content = $data["contnet"];/*
	$str .="<tr><td>ID</td><td>".$data["id"]."</td></tr><tr><td>title</td><td>".$data["title"]."</td><tr><td>content</td><td>".$data["contnet"]."</td></tr><tr><td>date</td><td>".$data["date]"."</td></tr>";
   */
        $str .= "<tr><td>Idx</td><td><input type='hidden' id='idx' name='idx' value='$idx'>" . $idx;
        $str .= "</td></tr><tr><td>ID</td><td><input type='hidden' id='id' name='id' value='$id'>" . $id;
        $str .= "</td></tr><tr><td>title</td><td><input type='hidden' id='title' name='title' value='$title'>" . $title;
        $str .= "</td><tr><td><input type='hidden' id='content' name='content' value='$content'>content</td><td height='400px' >" . $content;
        $str .= "</td></tr><tr><td>date</td><td>" . $date . "</td></tr>";
    }
} else {
    echo "ERRor " . $sql_page . "" . mysqli_error($con);
}

?>

<html>
<head>
    <title> 게시판 글쓰기 </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div align=center><h3> board detail </h3></div>
<form action='board_write.php' method='post'>
    <div width=50%>
        <table class='table table-striped'>
            <?php echo $str; ?>
        </table>
    </div>

    <div align=center>
        <button type='button' onclick="location.href='board_list.php?pageNum=<?php echo $_GET['pageNum']?>'" class='btn btn-outline-primary'>목록</button>
        <button class='btn btn-outline-primary'><input type='hidden' id='change' name='change' value='change'> 수정
        </button>
        <button type='button' onclick="deleteDetail(<?php echo $idx; ?>)" class='btn btn-outline-danger'>삭제</button>
    </div>

</form>


<script>
    function deleteDetail(idx) {
        window.open("board_delete_action.php?idx=" + idx, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=300,height=200");
    }
</script>

</body>
</html>




