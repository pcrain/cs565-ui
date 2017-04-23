<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

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

<script>
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
                    <span class="fa fa-circle" style="color: #008800"><span class="legendText"> Typing   </span></span>
                    <span class="fa fa-circle" style="color: #880000"><span class="legendText"> Inactive</span></span>
                    <!-- <i class="fa fa-circle" style="color: #880000"></i><h3 align="center">Inactive</h3> -->
                </li>
                <li data-toggle="modal" data-target="#myModal">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #2b542c"></i> Jake (Active now) <i class="fa fa-question-circle-o"> </i></a>
                </li>
                <li data-toggle="modal" data-target="#myModal2">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #2b542c"></i> Kate (Active now)</a>
                </li>
                <li data-toggle="modal" data-target="#myModal3">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #761c19"></i> Rose (Not started)</a>
                </li>
                <li  data-toggle="modal" data-target="#myModal1">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #8a6d3b;"></i> John (2 hours ago) <i class="fa fa-question-circle-o" data-toggle="modal" data-target="#myModal1"> </i></a>
                </li>
                <li data-toggle="modal" data-target="#myModal4">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #2b542c"></i> Andy (Active now)</a>
                </li>
                <li data-toggle="modal" data-target="#myModal5">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #761c19"></i><span class="tooltiptext"> Sarah (Not started)</span></a>
                </li>


                <!-- <hr style="background-color: white"> -->

                <!-- <h3 align="center">Other Users </h3> -->
                <br>


                <li data-toggle="modal" data-target="#myModal6">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #8a6d3b;"></i> darth (1 hour ago)</a>
                </li>
                <li data-toggle="modal" data-target="#myModal7">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #2b542c"></i> rugby (Active now)</a>
                </li>
                <li data-toggle="modal" data-target="#myModal8">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #761c19"></i> Kingruler (Not started)</a>
                </li>

                <li data-toggle="modal" data-target="#myModal9">
                    <a href="#" style="font-size: large";> <i class="fa fa-circle" style="color: #2b542c"></i> iloveblue (Active now)</a>
                </li>
            </ul>
        </div>


        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 align="center">
                        <!-- <i class="fa fa-circle" style="color: #2b542c"></i> -->
                        <u>Write a Review of Your Favorite Book</u></h1>
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

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" align="center">Jake</h4>
                    </div>
                    <div class="modal-body">
                        <p>Number of Words: 320</p>
                        <p>Time Spent: 2 hours</p>
                        <p>Progress: 70%</p>
                        <p>"Stuck on question 1"</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="myModal1" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">John</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 500</p>
                        <p>Time Spent: 3 hours</p>
                        <p>Progress: 90%</p>
                        <p>"Stuck on question 10"</p>
                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal2" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Kate</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 200</p>
                        <p>Time Spent: 4 hours</p>
                        <p>Progress: 96%</p>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal3" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Rose</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 0</p>
                        <p>Time Spent: 0</p>
                        <p>Progress: 0%</p>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal4" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Andy</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 50</p>
                        <p>Time Spent: 30 mins</p>
                        <p>Progress: 6%</p>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal5" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Sarah</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 0</p>
                        <p>Time Spent: 0</p>
                        <p>Progress: 0%</p>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal6" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">darth</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 200</p>
                        <p>Time Spent: 2 hours</p>
                        <p>Progress: 35%</p>
                        <button data-dismiss="modal"> Add as Favourite</button>


                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal7" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">rugby</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 23</p>
                        <p>Time Spent: 10 mins</p>
                        <p>Progress: 2%</p>
                        <button data-dismiss="modal"> Add as Favourite</button>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal8" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Kingruler</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 0</p>
                        <p>Time Spent: 0</p>
                        <p>Progress: 0%</p>
                        <button data-dismiss="modal"> Add as Favourite</button>

                    </div>
                </div>

            </div>
        </div>

         <div class="modal fade" id="myModal9" role="dialog" style="text-align: center;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">iloveblue</h4>
                    </div>
                    <div class="modal-body">
                        <p >Number of Words: 700</p>
                        <p>Time Spent: 5 hours</p>
                        <p>Progress: 99%</p>
                        <button data-dismiss="modal"> Add as Favourite</button>

                    </div>
                </div>

            </div>
        </div>

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
        var utimespent = document.getElementsByTagName('time')[0].textContent;
        // alert(mysql_real_escape_string(words));
        post("submission.php",
            {
                textcontent: words,
                timespent: utimespent
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
            ss += '<p >Number of Words: '+user["nWords"]+'</p>';
             ss += '<p>Time Spent: '+user["active"]+' mins</p>'; //Hardcoded for now
            ss += '<p>Progress: '+Math.min(100,Math.floor(user["progress"]))+'%</p>';
            ss += '</div></div></div></div>';

            $("#wrapper").append(ss);
        }
        return users;
    }

    // genUsers(20);

    </script>

    <script src="timer.js"></script>
    <script src="chance.min.js"></script>
    <script src="virtual_people.js"></script>

    <script type="text/javascript">
        var number = (function ask() {
          var n = prompt("Please enter your first name:");
          return ((n == null) || (n.length < 2)) ? ask() : n;
        }());
    </script>
</body>

</html>
