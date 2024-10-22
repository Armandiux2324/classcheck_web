<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        body {
            background: #1C1E26;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container_calendar {
            width: 400px;
            height: 550px;
            margin: 5% auto;
        }
        .header_calendar {
            width: 100%;
            height: 45%;
            background: linear-gradient(#7F99F5, #506CF5);
            border-radius: 15px 15px 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }
        .header_calendar h1 {
            margin: 30px 0;
            font-family: Arial;
            font-size: 100px;
        }
        .header_calendar h5 {
            margin: 0;
            font-family: Arial;
            font-size: 40px;
        }
        .body_calendar {
            width: 100%;
            height: 55%;
            background: white;
            border-radius: 0 0 15px 15px;
            padding: 10px;
            box-sizing: border-box;
        }
        .container_change_month {
            width: 100%;
            height: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0.7;
        }
        .container_change_month button {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 20px;
            border: none;
            background: none;
            cursor: pointer;
        }
        .container_weedays {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .week_days_item {
            width: calc(100% / 7);
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #506CF5;
        }
        .container_days {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .container_days span {
            width: calc(100% / 7);
            text-align: center;
            padding: 10px 0;
            font-family: Arial;
            color: #4e4e4e;
        }
        .container_days .today {
            color: #506CF5;
        }
        .container_days .today::before {
            content: "";
            display: block;
            width: 19px;
            height: 19px;
            background: #506CF5;
            position: relative;
            top: -10px;
            left: calc(50% - 10px);
            border-radius: 50%;
            border: 5px solid #506CF5;
            opacity: 0.6;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var monthName = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                             "Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

            var now = new Date();
            var day = now.getDate();
            var month = now.getMonth();
            var year = now.getFullYear();

            function initCalender() {
                $("#text_day").text(day);
                $("#text_month").text(monthName[month]);
                $("#text_month_02").text(monthName[month]);
                $("#text_year").text(year);

                $(".container_days").empty();

                for(let i = startDay(); i > 0; i--){
                    $(".container_days").append(
                        `<span class="week_days_item prev_days">${getTotalDays(month-1)-(i-1)}</span>`
                    );
                }

                for(let i = 1; i <= getTotalDays(month); i++){
                    if(i == day && month == now.getMonth()){
                        $(".container_days").append(
                            `<span class="week_days_item today">${i}</span>`
                        );
                    } else {
                        $(".container_days").append(
                            `<span class="week_days_item">${i}</span>`
                        );
                    }
                }
            }

            function getNextMonth(){
                if(month !== 11){
                    month++;
                } else {
                    year++;
                    month = 0;
                }
                initCalender();
            }

            function getPrevMonth(){
                if(month !== 0){
                    month--;
                } else {
                    year--;
                    month = 11;
                }
                initCalender();
            }

            function startDay(){
                var start = new Date(year, month, 1);
                return start.getDay();
            }

            function leapYear(){
                return ((year % 400 === 0) || (year % 4 === 0) && (year % 100 !== 0));
            }

            function getTotalDays(){
                if(month === -1) month = 11;

                var numMonthReal = month + 1;

                if(numMonthReal == 3 || numMonthReal == 5 || numMonthReal == 8 || numMonthReal == 10){
                    return 30;
                } else if(numMonthReal == 1){
                    return leapYear() ? 29 : 28;
                } else {
                    return 31;
                }
            }

            $("#next_month").click(function(){
                getNextMonth();
            });

            $("#last_month").click(function(){
                getPrevMonth();
            });

            initCalender();
        });
    </script>
</head>
<body>
    <div class="container_calendar">
        <div class="header_calendar">
            <h1 id="text_day">00</h1>
            <h5 id="text_month">Null</h5>
        </div>
        <div class="body_calendar">
            <div class="container_change_month">
                <button id="last_month">&lt;</button>
                <div>
                    <span id="text_month_02">Null</span>
                    <span id="text_year">0000</span>
                </div>
                <button id="next_month">&gt;</button>
            </div>
            <div class="container_weedays">
                <span class="week_days_item">DOM</span>
                <span class="week_days_item">LUN</span>
                <span class="week_days_item">MAR</span>
                <span class="week_days_item">MÍE</span>
                <span class="week_days_item">JUE</span>
                <span class="week_days_item">VIE</span>
                <span class="week_days_item">SÁB</span>
            </div>
            <div class="container_days">
                <!-- Days will be generated dynamically here -->
            </div>
        </div>
    </div>
</body>
</html>
