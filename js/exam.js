'use strict';

/* js wirte for exam0
 * design and code by Yuzo
 */
$(function() {
    $('.answer').blur(function() {
        if (!$(this).val()) {
            $(this).parent().removeClass('has-success');
            $(this).parent().addClass('has-error');
        } else {
            $(this).parent().removeClass('has-error');
            $(this).parent().addClass('has-success');
        }
    })

    $('button').click(function(event) {
        var answers = [];

        $('.answer').each(function() {
            var item = {
                question: $(this).attr('question'),
                answer: $(this).val()
            }
            answers.push(item);
        });
        var postData = {
            userID: $.cookie('userID'),
            examID: $.cookie('examID'),
            answers: answers
        }

        //console.log(postData);
        $.ajax({
            type: "POST",
            url: 'submit.php',
            contentType: 'application/json',
            data: JSON.stringify(postData),
            processData: false,
            dataType: 'json',
            complete: function(xhr) {
                //console.log(xhr.responseText);
                if (xhr.responseText == 'Success') {
                    alert('试卷提交成功');
                    $.get('/api/score_json.php', function(data) {
                        $.each(data, function(index, val) {
                            if((val.examID) == $.cookie('examID')){
                                alert('本次考试成绩为' + val.score);
                            }
                        });
                    });
                } else {
                    alert('试卷提交失败');
                }
            }
        })
    });
})