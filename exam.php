<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>Exam</title> 
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a>
                    </li>
                    <li><a href="#about">About</a>
                    </li>
                    <li><a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" id="questions">
        <?php
            require_once('api/question_api.php');
            $examID = filter_input(INPUT_COOKIE, 'examID', FILTER_SANITIZE_NUMBER_INT);

            $questions = get_question($examID);

            $html = '';
            foreach ($questions as $key => $value) {
                $html .= '<div class="question form-group">';
                $html .= '<div class="alert alert-success">' . ($key+1) . '. 题号:' . $value['questionID'] . ' / ' . $value['question'] . ' / ' . $value['point'] . '分</div>';
                $html .= '<input type="text" class="form-control answer" placeholder="答案:" question="' . $value['questionID'] . '">';
                $html .= '</div>';
            }

            echo($html);
        ?>
		<button class="btn btn-primary">提交试卷</button>
    </div>

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/jquery.cookie/jquery.cookie.js"></script>
<script src="/js/exam.js"></script>
</body>
</html>