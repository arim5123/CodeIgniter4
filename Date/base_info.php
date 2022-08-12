<script type="text/JavaScript">

    function setData(){
        var aa = new Date();
        var year = aa.getFullYear(); //2022
        var month = aa.getMonth()+1; //8
        var date = aa.getDate(); //21
        var dayLabel = aa.getDay(); //금=5
        const label = ['일', '월', '화', '수', '목', '금', '토'];

        if(month < 10){
            month = String("0")+String(month);
        }

        var data = year + "." + month + "." + date;
        var todayLabel = label[dayLabel];

        document.getElementById("today_date").innerHTML = data + "." + todayLabel;

    }
    function timer() {
        $.ajax({
            type: "POST",
            url: "/admin/main/time_val",
            dataType: 'text',
            success : function(time_val) {
                var cnt = time_val * 60;
                console.log(cnt);
                setInterval(function() {
                    document.getElementById("Wrap").onclick = function() {
                        cnt = time_val * 60;
                    }
                    if( cnt == 0 ) {
                        clearInterval();
                        location.href = "/";
                    }
                    else { cnt--; }
                }, 1000);
            }
        });
    }

    function setClock(){
        var dateInfo = new Date();
        var hour = modifyNumber(dateInfo.getHours());
        var min = modifyNumber(dateInfo.getMinutes());
        document.getElementById("time").innerHTML = hour + ":" + min + "<span><?=$state?></span>";
    }

    function modifyNumber(time){
        if(parseInt(time)<10){
            return "0"+ time;
        } else return time;
    }

    window.onload = function(){
        timer();
        setClock();
        setData();
        setInterval(setClock,1000); //1초마다 setClock 함수 실행
    }

</script>
<script src="/bootstrap/js/jquery.min.js"></script>
<div class="today_area">
    <div id="today_date" class="today_date">
    <div id="time" class="time"></div>
</div>
