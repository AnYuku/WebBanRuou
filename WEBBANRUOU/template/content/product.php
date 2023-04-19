<?php
// Create connection
$conn = new mysqli('localhost', 'admin', 'admin', 'pubmanager');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM product
INNER JOIN category ON product.CatId = category.Catid";

$result = mysqli_query($conn, $sql);
?>


<div class="container">
    <img src="" alt="">
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<style>
    .container {
        background-color: rgba(217, 217, 217, 0.5);
        max-width: 90%;
        /* height: 90%; */
        margin: 10px auto;
        padding: 1rem;
    }

    .search-container {
        float: left;
        width: 60%;
        /* position: absolute; */
    }

    .add-product {
        float: right;
    }

    .search-container input[type=text] {
        padding: 6px;
        /* padding-right: 90%; */
        margin-top: 8px;
        font-size: 17px;
        border: none;
        background-color: #D9D9D9;
        width: 60%;
    }

    .search-container button {
        /* float: right; */
        position: absolute;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: solid 2px #D9D9D9;
        margin-right: 25px;
        cursor: pointer;
    }

    .search-container button:hover {
        background: #ccc;

    }

    .add-product button {
        background-color: #961313;
        padding: 6px;
        padding-left: 15px;
        padding-right: 15px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }

    .add-product button:hover {
        cursor: pointer;

    }

    .topnav input[type=text] {
        border: 1px solid #ccc;
    }

    .table-manager {
        /* display: flex; */
        flex-direction: column;
    }


    table {
        border-collapse: collapse;
        width: 100%;
        resize: horizontal;
        overflow: auto;
        /* table-layout: fixed; */
        /* height: 100%; */
        /* cursor: ew-resize; */
        /* outline: none; */

    }

    td:nth-child(1) {
        /* text-align: center; */
        width: 130px;
    }
    

    td:nth-child(4) {
        text-align: center;
        width: 35px;
    }

    td:nth-child(6) {
        text-align: center;
        width: 40px;
    }
    td:nth-child(7) {
        text-align: center;
        width: 108px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
        resize: horizontal;
        overflow: auto;
        word-wrap: break-word;
    }

    th {
        background-color: #961313;
        color: white;
        resize: horizontal;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .fa-toggle-on {
        color: green;
    }

    .fa-toggle-off {
        color: red;
    }


    /* CSS */
    .btn-edit {
        /* background-color: yellow; */
        border-style: none;
        padding: 5px;
    }

    .btn-edit:hover {
        cursor: pointer;
        text-decoration: underline;

    }

    .btn-del {
        /* background-color: yellow; */
        border-style: none;
        padding: 5px;
    }

    .btn-del:hover {
        cursor: pointer;
        text-decoration: underline;

    }



    /* CSS cho hộp thoại edit */
    .edit-form {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .edit-form-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .edit-form input[type=text],
    .edit-form input[type=number],
    .edit-form input[type=date] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .edit-form button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    .edit-form button:hover {
        background-color: #45a049;
    }
</style>