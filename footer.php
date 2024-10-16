<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        .footer {
            background-color: #161616;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 14px;
        }

        .foot-margin p {
            margin: 10px 0;
        }

        .modal-footer {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Page Content -->
</div>

<footer class="footer">
    <div class="container">
        <div class="foot-margin">
            <p><a>LMSai for Perpustakaan Desa Muadzam Shah. &copy; All Rights Reserved.</a> Designed By <a href="LMSai.php">Vishva Paramasivam</a></p>
        </div>
    </div>
</footer>

<!-- Modal and scripts -->

<div id="logout" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-danger">Are you sure you want to Logout</div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <a href="logout.php" class="btn btn-danger">Yes</a>
    </div>
</div>	

<script type='text/javascript' src='scripts/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='scripts/jquery.hoverIntent.minified.js'></script> 
<script type='text/javascript' src='scripts/diapo.js'></script> 
</body>
</html>
