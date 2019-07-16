<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
// $sql_page = mysql_query("select * from test.board order by idx desc limit $pageing,$lmt",$con);
// $list = mysql_num_rows($sql_page);

?>

<html>
<head>
    <title> 게시판 글쓰기 </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script>
    function saveBoard(a) {
        var id = document.getElementById('id').value;
        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;
        var pass = document.getElementById('pw').value;


    }

</script>

<?php
$idx = $_POST["idx"];
$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];

if ($_POST['change'] == "change")
    echo "<form action='board_change_action.php' method='post' >";
else
    echo "<form action='board_save_action.php' method='post' > ";
?>
<!--<form action='board_save_action.php' method='post' > -->
<table class='table table-striped'>
    <tr>
        <?php
        if ($_POST['change'] == "change")
            echo "<td>ID</td><td><input type='hidden' name='idx' id='idx' value=$idx>$id</td>";
        else
            echo "<td>ID</td><td><input type='text' id='id' name='id' ></td>";
        ?>
    </tr>
    <tr>
        <td>title</td>
        <td><input type='text' id='title' name='title' width='100' value=<?php echo $title; ?>></td>
    <tr>
        <td>content</td>
        <td><textarea id='content' name='content' cols='40' rows='20'><?php echo $content; ?></textarea></td>
    </tr>
    <tr>
        <td>password</td>
        <td><input type='password' id='pw' name='pw'></td>
    </tr>
</table>
<input type="hidden" name='page' id='page' value='write_board'>
<div align='center'><input type="submit" align='center' class='btn btn-lg  btn-outline-primary' value='확인'>
    <?php
    if ($_POST['change'] == "change")
        echo "<input type='button'  onclick='javascript:history.go(-1)'  align ='center'  class='btn btn-lg  btn-outline-primary'   value='취소' >";
    ?>
</div>
</form>
</body>
</html>






