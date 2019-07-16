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
$total_rows = mysqli_num_rows($data);

$count = $_POST['listCount'];
if ($count == null) $count = 5;

$btn = $total_rows % $count != 0 ? (int)($total_rows / $count) + 1 : (int)($total_rows / $count);

$pageNum = $_POST['pageNum'] == null ? 1 : $_POST['pageNum'];

if ($pageNum < 1) $pageNum = 1;
if ($pageNum >= $btn) $pageNum = $btn;

$page_str = "";
//if ($pageNum / 5 > 1) {
    $page_str .= "<button type='button' class = 'btn btn-outline-primary' onclick=first_last_page('first') > << </button> ";
//}
//if($pageNum > 1)
$page_str .= "<button type='button' class ='btn btn-outline-primary' onclick=next_prev_onepage('prev')> < </button>";

$startCount = $pageNum % 5 != 0 ? (($pageNum / 5)) * 5 : (($pageNum / 5) - 1) * 5 + 1;
if(($pageNum-1) % 5 != 0 ) $startCount  = $pageNum - (($pageNum-1)%5);
if ($startCount < 1) $startCount = 1;
$endCount = $pageNum % 5 != 0 && (int)($btn / 5) == (int)($pageNum / 5) ? $btn % 5 : 5;
if ($btn / 5 < 1) $endCount = $btn % 5;

for ($i = $startCount; $i < $startCount + $endCount; $i++) {
    if ($i == (int)$pageNum) {
        $page_str .= "<button type='button'  class ='btn btn-outline-danger' onclick=pageOnclick($i,this) id=$i name=$i value='$i' >$i</button>";
    } else {
        $page_str .= "<button type='button'  class ='btn ' onclick=pageOnclick($i,this) id=$i name=$i value='$i' >$i</button>";
    }
}

$not_five = "";
if ($endCount < 5) $not_five = 'ok';

$page_str .= "<input type='hidden' name='lastpage' id='lastpage' value='$btn'><button type='button' class='btn btn-outline-primary' onclick=next_prev_onepage('next')> > </button>";
//if ($btn / 5 >= ($pageNum + 5) / 5) {
    $page_str .= "<button type='button' class = 'btn btn-outline-primary' onclick=first_last_page('last')> >> </button>";
//}
echo $page_str;
?>
