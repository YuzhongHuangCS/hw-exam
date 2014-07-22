//js write for sdilod
$(function() {

    var w = window.screen.availWidth;
    var h = window.screen.availHeight;

    $('.chart').attr({
        'width': w / 1.9,
        'height': h / 1.7
    });

    $.getJSON('/api/score_json.php', function(data) {
    	var labels = []
        var exams = [];
        var scores = [];
        var th, td, table;

        $.each(data, function(index, val) {
            exams.push(val.examID);
            scores.push(val.score);
            th += '<th>' + val.examID + '</th>'
            td += '<td>' + val.score + '</td>'
        });

        table = '<tr><th>考试号</th>' + th + '</tr><tr><td>结果</td>' + td + '</tr></table>'

        $('#numResult').html(table);
        //console.log(scores);
        var scoreChart = {
            labels: exams,
            datasets: [{
                fillColor: "rgba(23,238,172,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: scores
            }]
        }
        new Chart($("#scoreChart").get(0).getContext("2d")).Line(scoreChart);
    });
})