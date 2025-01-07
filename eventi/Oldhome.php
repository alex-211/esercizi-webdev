<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!--moved all the css code to separate file-->
    <title>Smart Event Planner</title>
</head>
<?php
session_start();
$userId = $_SESSION['user-session'];

$servername = "34.17.71.245"; // hostato su google cloud 34.17.71.245
$username = "php";
$password = "f=v;RoiHHkVSvl/("; // TODO hash this to it's not plaintext 
$database = "event-planner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) // controlla se la connessione è avvenuta
{
  die("non funge: " . $conn->connect_error);
}

$query = "SELECT e_name, e_date, e_time FROM events WHERE e_owner = $userId";

?>
<body>
    <nav>
        <span id="navbar-title"></span>
        <div class="links">
            <a href="#">Aggiungi evento</a>
            <a href="#">Modifica evento</a>
            <a href="#">Visualizza evento</a>
            <a href="#">Classifica eventi</a>
            <a href="#">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="box" id="1">
            <div class="box-title">1</div>
            <ul class="events">
            <?php
                    if (isset($eventsByDay[$day])) {
                        foreach ($eventsByDay[$day] as $event) {
                            echo "<li>$event</li>";
                        }
                    }
                    ?>
            </ul>
        </div>
        <div class="box" id="2">
            <div class="box-title">2</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="3">
            <div class="box-title">3</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="4">
            <div class="box-title">4</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="5">
            <div class="box-title">5</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="6">
            <div class="box-title">6</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="7">
            <div class="box-title">7</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="8">
            <div class="box-title">8</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="9">
            <div class="box-title">9</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="10">
            <div class="box-title">10</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="11">
            <div class="box-title">11</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="12">
            <div class="box-title">12</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="13">
            <div class="box-title">13</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="14">
            <div class="box-title">14</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="15">
            <div class="box-title">15</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="16">
            <div class="box-title">16</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="17">
            <div class="box-title">17</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="18">
            <div class="box-title">18</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="19">
            <div class="box-title">19</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="20">
            <div class="box-title">20</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="21">
            <div class="box-title">21</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="22">
            <div class="box-title">22</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="23">
            <div class="box-title">23</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="24">
            <div class="box-title">24</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="25">
            <div class="box-title">25</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="26">
            <div class="box-title">26</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="27">
            <div class="box-title">27</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="28">
            <div class="box-title">28</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="29">
            <div class="box-title">29</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="30">
            <div class="box-title">30</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="31">
            <div class="box-title">31</div>
            <ul class="events"></ul>
        </div>
        <div class="box" id="test1">
            <div class="box-title">T1</div>
            <ul class="events">
                <li><h1>cazzo</h1></li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
                <li>cazzo</li>
            </ul>
        </div>
    </div>
    <div class="event-modifier">
        <hr>
        <h2 class="event-modifier-title"></h2>
    </div>
</body>
</html>
