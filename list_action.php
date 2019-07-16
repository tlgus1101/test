<?php
$host = '3.16.215.22';
$name = 'root';
$pw = 'tlgus1101';

$con = mysqli_connect($host, $name, $pw);
if (mysqli_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_error($con);
}

$query = "SELECT * FROM test.board";
$data = mysqli_query($con, $query);


//$btn = $total_rows%$count != 0 ? $total_rows/$count+1 : $total_rows/$count;
$total_rows = mysqli_num_rows($data);
$count = $_POST['listCount'];
if ($count == null) $count = 5;

$btn = $total_rows % $count != 0 ? (int)($total_rows / $count) + 1 : (int)($total_rows / $count);
$pageNum = $_POST['pageNum'] == null ? 1 : $_POST['pageNum'];
if ($pageNum < 1) $pageNum = 1;
if ($pageNum >= $btn) $pageNum = $btn;

$start = ($pageNum - 1) * $count;
if ($start == null) $start = 0;
$end = $count;

//$page_str = "<div align='center' >";
$sql_page = "select pg.* from( select * from test.board)pg  order by idx desc LIMIT $start, $end ;";


//$str = sprintf("<table class='table table-striped table-hover '><thead><tr><td>번호</td><td>작성자</td><td>제목</td><td>내용</td><td>날짜</td></thead><tbody>");
$arr = array();
if ($result = mysqli_query($con, $sql_page)) {
    while ($row = mysqli_fetch_array($result)) {
        //   $str .= sprintf("<tr><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td> %s </td>",$row['idx'],$row['id'],$row['title'],$row['contnet'],$row['date']);
        //$temArr = array('idx'=>$row['idx'],'id'=>$row['id'],'title'=>$row['title'],'content'=>$row['contnet'],'date'=>$row['date'] );
        $temArr = array('idx' => $row['idx'], 'id' => $row['id'], 'title' => $row['title'], 'd_date' => $row['date']);
        $arr[] = $temArr;
    }
    // $str.=sprintf("</tbody></table>");
    // echo $str;
    //$board_list = json_encode($str);
    $board_list = json_encode($arr);
    //$pageing = json_encode($page_str);
} else {
    echo "ERRor " . $sql_page . "" . mysqli_error($con);
}

echo json_encode($arr);
?>
