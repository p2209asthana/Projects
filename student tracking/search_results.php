<?php
require_once 'session_handler.php';
checkSession();
?>
<link rel="stylesheet" type="text/css" href="assets/css/jasny-bootstrap.min.css">
<script src="assets/js/jasny-bootstrap.js"></script>
<body>    
    <div class="banner">
        <div class="banner-content">
            <h1>Student Tracking System</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="col-sm-2" style="margin-top: 120px;">
            <a href="index.php#searchRecord">Go Back</a>
        </div>
        <div class="col-sm-5" style="margin-top: 100px;margin-left: 300px">
            <h3>Showing results for "Searched query"</h3>    
        </div>
        
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr><th>#</th><th>Registration Id</th><th>Name</th><th>D.O.B</th></tr>
            </thead>
            <tbody data-link="row" class="rowlink">
                <tr><td><a href="#">1</a></td><td>1234ABCD</td><td>Name Lastname</td><td class="rowlink-skip"><a href="#">View</a></td></tr>
                <tr><td><a href="#">2</a></td><td>1234ABCD</td><td>Name Lastname</td><td class="rowlink-skip"><a href="#">View</a></td></tr>
                <tr><td><a href="#">3</a></td><td>1234ABCD</td><td>Name Lastname</td><td class="rowlink-skip"><a href="#">View</a></td></tr>
            </tbody>    
        </table>
    </div>
    
