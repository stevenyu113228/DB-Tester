<!DOCTYPE html>
<html>

<head>
    <title> MySQL DB Tester</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body,
        textarea {
            background-color: #1E1E1E;
            color: #FFFFFF;
        }

        h1 {
            display: inline;
        }
    </style>
</head>

<body>
    <h1> PostgreSQL DB Tester </h1>
    <a> By Steven Meow 😺 </a>
    <br>

    <?php
      $host        = "host=pgsql";
      $dbname      = "dbname=postgres";
      $port        = "port=5432";
      $credentials = "user=postgres password=root";
   
      $conn = pg_connect( "$host $port $dbname $credentials"  );
      if(!$conn){
         echo "Error : Unable to open database\n";
      } else {
         echo "Opened database successfully\n";
      }
    ?>

    <form method="get">
        <textarea rows="5" cols="80" name="query">
<?php
if (isset($_GET['query'])) {
    echo $_GET['query'];
}
?>
</textarea>
        <br>
        <input type="submit">
        <button type="button" onclick="clean()">Clear</button>
        <button type="button" onclick="create_schema()">Create Schema</button>
        <button type="button" onclick="create()">Create Table</button>
        <button type="button" onclick="insert()">Insert Content</button>
        <button type="button" onclick="select()">Select Content</button>
        <button type="button" onclick="location.pathname = 'adminer-4.8.1.php'">Adminer</button>
    </form>
    <script>
        function clean() {
            document.body.getElementsByTagName("textarea")[0].textContent = "";
        }

        function create() {
            document.body.getElementsByTagName("textarea")[0].textContent = `CREATE TABLE test_db.accounts(
id SERIAL NOT NULL PRIMARY KEY,
username TEXT NOT NULL,
password TEXT NOT NULL)`;
        }
        function create_schema() {
            document.body.getElementsByTagName("textarea")[0].textContent = 'CREATE SCHEMA test_db';
        }
        function rnd_str() {
            return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
        }

        function insert() {
            document.body.getElementsByTagName("textarea")[0].textContent = `INSERT INTO test_db.accounts(username,password) VALUES('meow_${rnd_str()}','meowpass_${rnd_str()}')`;
        }

        function select() {
            document.body.getElementsByTagName("textarea")[0].textContent = 'SELECT * FROM test_db.accounts'
        }
    </script>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $result = pg_query($conn,$query);
        echo "<a>Previous Query: <strong style='color:#60C5F1'>" . $_GET['query'] . "</strong></a>\n";
        echo "<br><br>\n";

        if (preg_match("/^select/i", $_GET['query'])) {
            echo "Previous Result:";
            echo "<table class='table table-bordered table-dark table-hover'>\n";
            while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
    }
    ?>