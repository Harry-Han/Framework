<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=gb2312" />
        <title></title>
        <script type="text/javascript">function showHint(str) {
            var xmlhttp;
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
                }
                xmlhttp.open("GET", "gethint.php?q=" + str, true);//三个参数，第一个传值方式，第二个URL，第三个同/异步
                xmlhttp.send();
            }</script>
    </head>
    <body>
        <h3>请在下面的输入框中键入字母（A - Z）：</h3>
        <form action="">姓氏：
            <input type="text" id="txt1" onkeyup="showHint(this.value)" /></form>
        <p>建议：
            <span id="txtHint"></span></p>
    </body>

</html>