<!DOCTYPE html>
<html>
<head>
    <title>Navigation Bar</title>
    <style>
        nav {
            background-color: black;
        }

        nav ul {
            display: flex;
            list-style-type: none;
            margin:20px;
            padding: 0;
            overflow: hidden;
            padding-left: 80px;
            font-family: sans-serif;
            font-size: 1.2rem;
            
        }

        nav li {
            float: left;
            padding-left: 50px;
        }

        nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav li a:hover {
            background-color:black;
        }

        .search-form {
            display: inline-block;
            margin-top: 10px;
           
        }

        .search-form input[type="text"] {
            padding: 8px;
            border-radius: 20px;
           height: 30px;
           width: 300px;
            background: transparent;
            font-size: 1.1rem;
            font-family: sans-serif;
            border: 1px solid rgb(114, 106, 66);
        }
        button{
            background-color: green;
            color: white;
            font-size: 1.1rem;
            font-family: sans-serif;
            height: 40px;
            padding: 5px;
            border-radius: 20px;
        }
        

    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Sports</a></li>
            <li><a href="#">Music</a></li>
            <li><a href="#">Shows</a></li>
            <li class="search-form">
                <form action="#" method="get">
                    <input type="text" name="search" placeholder="Search">
                    
                </form>
            </li>
            <li><a href="#">Logout</a></li>
            <li ><a href="./check.php"><button>Create-Event</button></a></li>
        </ul>
    </nav>
</body>
</html>