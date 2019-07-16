<html>
<head><title>board</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<script>
    function boardAjaxCallback(data) {
        var body = $("#tb");
        body.empty();
        var d = JSON.parse(data);

        var str = "<table class='table table-striped table-hover '><thead><tr><td>번호</td><td>작성자</td><td>제목</td><td>날짜</td></thead><tbody>";

        $.each(d, function (key, value) {
            str += "<tr><div class='item'>"
                + "<td>" + value.idx + "</td>"
                + "<td>" + value.id + "</td>"
                + "<td><input type='hidden' name='idx' id='idx' value='" + value.idx + "'><a  name='board_detail' id='board_detail' >"
                + value.title
                + "</td>"
                + "<td>"
                + value.d_date + "</td>"
                + "</div></tr>";

        });
        /*
            for(var i=0; i<d.length;i++){
                str += "<tr><div>";
                for(var v in d[i]){
                    // alert(v);
                    if(v=='idx'){  str += "<input type='hidden' id='idx' name='idx' value='"+d[i][v]+"' >"
                    }
                    if(v=='title'){str += "<td><a href='#'  id='board_detail' name='board_detail'>"+d[i][v]+"</a></td>";
                    } else str += "<td>"+d[i][v]+"</td>";
                }
                str+= "</div></tr>";
            }

            $("a[name='board_detail']").on("click",function(e){
                    e.preventDefault();
                    boardDetail($(this));
                    });
            */
        str += "</tbody></table>";
        body.append(str);
        $("a[name='board_detail']").on("click", function (e) {
            e.preventDefault();
            boardDetail($(this));
        });
    }
</script>
<form>
    <?php
    $listCount = $_POST['listCount'];
    if ($listCount == '') $listCount = 5;

    echo "<select name='listCount' id='listCount' onchange=ch(this); > <option value='5'>5</option> <option value='10'>10</option> <option value='20'>20</option> <option value='50'>50</option> </select> <a id='write' name='write' class='btn btn-default pull-right '>글쓰기</a>";
    ?>
    <div id="tb" name="tb"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <script>
        function ch(s) {
            boardAjax();
            pageingAjax();
        }

        function boardDetail(obj) {
            var pageNum = Number($('.btn-outline-danger').attr('id'));
	    var idx = $(obj).parent().find('#idx').val();
            this.document.location.href = "board_detail.php?idx=" + idx+"&pageNum="+pageNum;

        }

        function next_prev_onepage(next_prev) {
            var page = 0;
            var pageNum = Number($('.btn-outline-danger').attr('id'));

            if (next_prev == 'next') {
                page = parseInt((pageNum+5) / 5) * 5+1;
            } else {
                page = parseInt((pageNum - 5) / 5) * 5+1;
            }
            pageingAjax(page);
            boardAjax(page);
        }

	function first_last_page(first_last) {
            var page = 0;
            var pageNum = Number($('.btn-outline-danger').attr('id'));

            if (first_last == 'first') {
                page = 1;
            } else {
                page = Number(document.getElementById("lastpage").value);;
            }
            pageingAjax(page);
            boardAjax(page);
        }

/*
        function n_p_page(next_prev) {
            var lastpage = Number(document.getElementById("lastpage").value);
            var page = Number($('.btn-outline-danger').attr('id'));

            if (next_prev == 'one_next') {
                    page += 1;
            } else {
                page -= 1;
            }

            if(lastpage >= page ) {
                $('button').removeClass('btn-outline-danger');
                $('#' + page).addClass("btn-outline-danger");
                boardAjax(page);
                if ((page) % 5 == 1 || (page) % 5 == 0) {
                    pageingAjax(page);
                }
            }

        }
*/
        function pageOnclick(pageNum, a) {
            boardAjax(pageNum);
            $('button').removeClass('btn-outline-danger');
            $(a).addClass("btn-outline-danger");
        }

        function pageingAjax(pageNum) {
            var sle = document.getElementById("listCount").value;
            $.ajax({
                url: "pageing.php",
                type: "post",
                data: {'listCount': sle, 'pageNum': pageNum},   // $("form").serialize(), data:  $("form").serialize(),
            }).done(function (data) {
                var ppp = $("#page");
                ppp.empty();
                ppp.append(data);
            });
        }

        function boardAjax(pageNum) {
            var sle = document.getElementById("listCount").value;
            $.ajax({
                url: "list_action.php",
                type: 'POST',
                data: {'listCount': sle, 'pageNum': pageNum},   // $("form").serialize(),
            }).done(function (data) {
                data.board_list;
                boardAjaxCallback(data);
            });
        }

        $(document).ready(function () {
            boardAjax();
            pageingAjax(<?php echo $_GET['pageNum']?>);
            $("a[name='write']").on("click", function (e) {
                e.preventDefault();
                window.open("board_write.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=700");
            });
            $("a[name='board_detail']").on("click", function (e) {
                e.preventDefault();
                boardDetail($(this));
            });
        });

    </script>
    <div align='center' name="page" id="page"></div>


</form>
</body>
</html>

