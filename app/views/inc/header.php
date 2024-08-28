<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round"> 
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <title>Document</title>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT;  ?>styles/font-awesome.min.css">
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
     <script src="<?php echo URLROOT;  ?>js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style>
 
      body {
       /* background: #eeeeee;*/
       
        font-family: 'Open Sans', sans-serif;
      }
        .form-inline {
            display: inline-block;
        }
      .navbar {
        font-size: 14px;
        background: #fff;
        padding-left: 16px;
        padding-right: 16px;
        border-bottom: 1px solid #d6d6d6;
        box-shadow: 0 0 4px rgba(0,0,0,.1);		
      }
      .navbar .navbar-brand {
        color: #555;
        padding-left: 0;
        font-size: 20px;
        padding-right: 50px;
        font-family: 'Raleway', sans-serif;
        text-transform: uppercase;
      }
      .navbar .navbar-brand b {
        font-weight: bold;
        color: #f04f01;
      }
      .navbar ul.nav li {
        font-size: 96%;
        font-weight: bold;		
        text-transform: uppercase;
      }
      .navbar ul.nav li.active a, .navbar ul.nav li.active a:hover, .navbar ul.nav li.active a:focus {
        color: #f04f01 !important;
        background: transparent !important;
      }
      .search-box {
            position: relative;
        }
      .search-box input.form-control, .search-box .btn {
        font-size: 14px;
        border-radius: 2px !important;
      }
      .search-box .input-group-btn {
        padding-left: 4px;		
      }
      .search-box input.form-control:focus {
        border-color: #f04f01;
        box-shadow: 0 0 8px rgba(240,79,1,0.2);
      }
      .search-box .btn-primary, .search-box .btn-primary:active {
        font-weight: bold;
        background: #f04f01;
        border-color: #f04f01;
        text-transform: uppercase;
        min-width: 90px;
      }
      .search-box .btn-primary:focus {
        outline: none;
        background: #eb4e01;
        box-shadow: 0 0 8px rgba(240,79,1,0.2);
      }
      .search-box .btn span {
        transform: scale(0.9);
        display: inline-block;
      }
      .navbar ul li i {
        font-size: 18px;
      }
      .navbar .dropdown-menu i {
        font-size: 16px;
        min-width: 22px;
      }
      .navbar .dropdown.open > a {
        background: none !important;
      }
      .navbar .dropdown-menu {
        border-radius: 1px;
        border-color: #e5e5e5;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
      }
      .navbar .dropdown-menu li a {
        color: #777;
        padding: 8px 20px;
        line-height: normal;
        font-size: 14px;
      }
      .navbar .dropdown-menu li a:hover, .navbar .dropdown-menu li a:active {
        color: #333;
      }
      .navbar .navbar-form {
        border: none;
      }
      @media (min-width: 992px){
        .form-inline .input-group .form-control {
          width: 225px;			
        }
      }
      @media (max-width: 992px){
        .form-inline {
          display: block;
        }
      }
    </style>
    <style>
        body {
          /*background-image: url('<?php echo URLROOT;  ?>styles/photo_6010331265443676936_y.jpg');*/
            color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
        /*filter:brightness(1.5);*/
      }
      .table-responsive {
            margin: 30px 0;
        }
      .table-wrapper {
        min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
        border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
      .table-title {        
        padding-bottom: 15px;
        background: #435d7d;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
      }
      .table-title .btn-group {
        float: right;
      }
      .table-title .btn {
        color: #fff;
        float: right;
        font-size: 13px;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
      }
      .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
      }
      .table-title .btn span {
        float: left;
        margin-top: 2px;
      }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
        }
      table.table tr th:first-child {
        width: 100px;
      }
      table.table tr th:last-child {
        width: 190px;
      }
        table.table-striped tbody tr:nth-of-type(odd) {
          background-color: #fcfcfc;
      }
      table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
      }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }	
        table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
            margin: 0 5px;
        }
      table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
      }
      table.table td a:hover {
        color: #2196F3;
      }
      table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #F44336;
        }
        table.table td a.deletem {
          color: #2da100;
      }
      table.table td a.deletem1 {
          color: #3f51b5;
      }
      table.table td a.deletem2 {
          color: #2196f3;
      }
        table.table td i {
            font-size: 19px;
        }
      table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
      }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }
        .pagination li a:hover {
            color: #666;
        }	
        .pagination li.active a, .pagination li.active a.page-link {
            background: #03A9F4;
        }
        .pagination li.active a:hover {        
            background: #0397d6;
        }
      .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }    
      /* Custom checkbox */
      .custom-checkbox {
        position: relative;
      }
      .custom-checkbox input[type="checkbox"] {    
        opacity: 0;
        position: absolute;
        margin: 5px 0 0 3px;
        z-index: 9;
      }
      .custom-checkbox label:before{
        width: 18px;
        height: 18px;
      }
      .custom-checkbox label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        background: white;
        border: 1px solid #bbb;
        border-radius: 2px;
        box-sizing: border-box;
        z-index: 2;
      }
      .custom-checkbox input[type="checkbox"]:checked + label:after {
        content: '';
        position: absolute;
        left: 6px;
        top: 3px;
        width: 6px;
        height: 11px;
        border: solid #000;
        border-width: 0 3px 3px 0;
        transform: inherit;
        z-index: 3;
        transform: rotateZ(45deg);
      }
      .custom-checkbox input[type="checkbox"]:checked + label:before {
        border-color: #03A9F4;
        background: #03A9F4;
      }
      .custom-checkbox input[type="checkbox"]:checked + label:after {
        border-color: #fff;
      }
      .custom-checkbox input[type="checkbox"]:disabled + label:before {
        color: #b8b8b8;
        cursor: auto;
        box-shadow: none;
        background: #ddd;
      }
      /* Modal styles */
      .modal .modal-dialog {
        max-width: 400px;
      }
      .modal .modal-header, .modal .modal-body, .modal .modal-footer {
        padding: 20px 30px;
      }
      .modal .modal-content {
        border-radius: 3px;
      }
      .modal .modal-footer {
        background: #ecf0f1;
        border-radius: 0 0 3px 3px;
      }
        .modal .modal-title {
            display: inline-block;
        }
      .modal .form-control {
        border-radius: 2px;
        box-shadow: none;
        border-color: #dddddd;
      }
      .modal textarea.form-control {
        resize: vertical;
      }
      .modal .btn {
        border-radius: 2px;
        min-width: 100px;
      }	
      .modal form label {
        font-weight: normal;
      }	
      #status-dotun {
            height: 8px;
            width: 8px;
            border-radius: 50%;
            display: inline-block;
            background-color: rgb(30, 196, 30);
        }
      #status-dotuf {
            height: 8px;
            width: 8px;
            border-radius: 50%;
            display: inline-block;
            background-color: rgb(255, 166, 0);
      }
    </style> 
    <script>
    $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
      // Select/Deselect checkboxes
      var checkbox = $('table tbody input[type="checkbox"]');
      $("#selectAll").click(function(){
        if(this.checked){
          checkbox.each(function(){
            this.checked = true;                        
          });
        } else{
          checkbox.each(function(){
            this.checked = false;                        
          });
        } 
      });
      checkbox.click(function(){
        if(!this.checked){
          $("#selectAll").prop("checked", false);
        }
      });
    });
    </script>
</head>
<body>