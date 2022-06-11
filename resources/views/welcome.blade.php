<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Test</title>



    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #container {
            width: 640px;
            /* Can be in percentage also. */
            height: auto;
            margin: 0 auto;
            padding: 10px;
            position: relative;
        }

        .details {
            background-color: #fff;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-top: 10px;
            width: 400px;
        }

        #search_form {
            background-color: #cccccc73;
            height: 700px;
            overflow: auto;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 30px;
            padding-bottom: 30px;
            width: 1000px;
            margin-left: -153px;
        }

        #search_input {
            background-color: #faf7f7c7;
            border: none;
            padding-left: 10px;
            height: 50px;
            width: 830px;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div id="container" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="align-content: center">
            <!-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0"> -->
            <form id="search_form" name="search_form">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <h3>Search</h3>
                <input type="text" name="search_input" id="search_input" placeholder="Search Name/ Designation/ Department">
                <div id="resultData">
                    <!-- <div id="resultData" style="display: flex; justify-content: ; width:900px"> -->

                    <div class="details" id="details" style="display: none ;">

                        <h3 id="user_name"></h3>
                        <p id="department_name"></p>
                        <p id="designation_name"></p>
                    </div>
                </div>
            </form>
            <!-- </div> -->
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        callSearch();
        $("#search_input").on('keyup', function(e) {
            e.preventDefault();
            callSearch();
        });
    });

    //function to search data`
    function callSearch() {
        $.ajax({
            type: 'get',
            url: '/searchData',
            data: {
                'search_data': $("#search_input").val(),
            },
            success: function(result) {
                i = 1;
                data = result.data;
                if ($(".detail_child")[0]) {
                    $('.detail_child').remove();
                }
                $.each(data, function(k, v) {
                    $(".details:last").find($("#user_name").html(v.user_name));
                    $(".details:last").find($("#department_name").html(v.department_name));
                    $(".details:last").find($("#designation_name").html(v.designation_name));
                    $("#details").clone().attr("id", "details_" + i).addClass("detail_child").insertAfter("div.details:last").show();
                    i++;
                });
            }
        });
    }
</script>

</html>