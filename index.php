<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Write a Review</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">




    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php
    $good = false;
    if ($_GET['c'] == "29472303298573462465") {
        $good = true;
    }
    if ($_GET['c'] == "20453436234763468785") {
        $good = true;
    }
    if (! $good) {
        exit("You are not authorized to access this page at this time.");
    }
?>

<script>
    var globalname = "";
    function post(path, params, method) {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                form.appendChild(hiddenField);
             }
        }

        document.body.appendChild(form);
        form.submit();
    }
</script>

<body onload="username()">


    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <span class="fa fa-circle" style="color: #107896"><span class="legendText"> Typing   </span></span>
                    <span class="fa fa-circle" style="color: #444444"><span class="legendText"> Inactive</span></span>
                    <!-- <i class="fa fa-circle" style="color: #880000"></i><h3 align="center">Inactive</h3> -->
                </li>
            </ul>
        </div>

        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <b><h1 align="center">Write a review of your favorite movie</h1></b>
                        <p align="center">Minimum 150 words. Please use our interface for the writing task (we will know if you don’t), and complete a short survey afterwards. Paste the task code you receive after completing the writing assignment to both the survey and to the HIT on Mechanical Turk.</p>
                        <!-- <h1 align="center"><i class="fa fa-circle" style="color: #2b542c"></i><u>Assignment 1</u></h1> -->
                        <p align="center">Time active: <time>00:00:00</time></p>
                        <p align="center"> Total Words: <span id="display_count">0</span>
                        <br><br>
                        <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">See users</a> -->
                        <!-- <br><br> -->

                       <textarea id="word_count" placeholder="Enter your answer here" style="width:100%; height:350px;"></textarea>
                       <a type="submit" class="btn btn-default" onclick="javascript:submitText();">Submit</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <script>
        $(document).ready(function() {
  $("#word_count").on('keyup', function() {
    var words = this.value.match(/\S+/g).length;


      $('#display_count').text(words);

    });
  });

    function submitText() {
        var words = document.getElementById("word_count").value;

        if (parseInt(words.length) >= 150) {
          // alert(words);
        } else {
          alert("Need at least 150 words");
          return;
        }

        var utimespent = document.getElementsByTagName('time')[0].textContent;
        var uname =
        // alert(mysql_real_escape_string(words));
        post("submission.php",
            {
                textcontent: words,
                timespent: utimespent,
                username: globalname
            }
        );
        // document.getElementById("word_count").value = "";
        // window.location.href="submission.html"
    }

    function genUsers(users) {
        // alert(JSON.stringify(users)); return;

        $(".sidebar-nav li:not(.sidebar-brand)").remove();
        // alert("yo");
        // var users = [];
        $(".modal:not(.in)").remove();
        for (var i = 0; i < users.length; ++i) {
            var user = users[i];
            if (user["progress"] >= 100 || user["state"] == 0) continue;
            // alert(JSON.stringify(user));

            var status = "";
            if (user["state"] == 0) status = "Not Started";
            if (user["state"] == 1) status = "Inactive";
            if (user["state"] == 2) status = "Typing Now";
            if (user["state"] == 3) status = "Completed";

            // user["status"] = "Active now";
            // alert(JSON.stringify(user));
            // users.push(user);
            var ss = '<li data-toggle="modal" data-target="#myModal'+(i+1)+'">';
            ss += '<a href="#" style="font-size: large";>'
            ss += '<i class="fa fa-circle" style="color:' + user["color"] + '"></i> ';
            ss += "<span class='sidebarUsename'>" + user["name"] + "</span>";
            // ss += " (" + status +")"
            ss += "</a></li>";
            // alert(ss);
            $(".sidebar-nav").append(ss);


            var ss = "";
            ss += '<div class="modal fade" id="myModal'+(i+1)+'" role="dialog" style="text-align: center;">';
            ss += '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">';
            ss += '<button type="button" class="close" data-dismiss="modal">&times;</button>'
            ss += '<h4 class="modal-title" align="center">'+user["name"]+'</h4></div>';
            ss += '<div class="modal-body">';
            ss += '<p >Number of Words Typed: '+user["nWords"]+'</p>';
             ss += '<p>Time Spent Typing: ~'+user["active"]+' seconds</p>'; //Hardcoded for now
            // ss += '<p>Progress: '+Math.min(100,Math.floor(user["progress"]))+'%</p>';
            ss += '</div></div></div></div>';

            $("#wrapper").append(ss);
        }
        return users;
    }

    // genUsers(20);

    </script>

    <script type="text/javascript">

        var $_GET = {};
        if(document.location.toString().indexOf('?') !== -1) {
            var query = document.location
                           .toString()
                           // get the query string
                           .replace(/^.*?\?/, '')
                           // and remove any existing hash string (thanks, @vrijdenker)
                           .replace(/#.*$/, '')
                           .split('&');

            for(var i=0, l=query.length; i<l; i++) {
               var aux = decodeURIComponent(query[i]).split('=');
               $_GET[aux[0]] = aux[1];
            }
        }

        //Cond 1 = 2947265
        //Cond 2 = 2045385

        var cond = 0;
        if ($_GET['c'] == "29472303298573462465") {
            cond = 1;
        }
        if ($_GET['c'] == "20453436234763468785") {
            cond = 2;
        }
        // alert(cond);
    </script>

    <script src="timer.js"></script>
    <script src="chance.min.js"></script>
    <script src="names.js"></script>
    <script src="virtual_people.js"></script>

    <script type="text/javascript">
        var globalname = (function ask() {
          var n = prompt("Please enter a username:");
          return ((n == null) || (n.length < 2)) ? ask() : n;
        }());
    </script>
</body>

</html>
