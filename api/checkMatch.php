<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data["name"];
        $likedUsers = json_decode(file_get_contents("../like.json"), true);
        if (in_array($_SESSION["currentUser"], $likedUsers[$name]))
        {
            echo "true";
            // write to json match.json format {"name": [ "match1", "match2", ... ] }
            $match = json_decode(file_get_contents("../match.json"), true);
            if (!isset($match[$_SESSION["currentUser"]]))
            {
                $match[$_SESSION["currentUser"]] = array();
            }
            if (!isset($match[$name]))
            {
                $match[$name] = array();
            }
            if (!in_array($name, $match[$_SESSION["currentUser"]]))
                $match[$_SESSION["currentUser"]][] = $name;
            else
                $match[$name][] = $_SESSION["currentUser"];
            file_put_contents("../match.json", json_encode($match));
        }
    }
?>