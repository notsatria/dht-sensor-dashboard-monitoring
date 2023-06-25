<?php

include "koneksi.php";

if (isset($_POST['FAN1_ON']))            // If press ON
{
    $sql = "UPDATE data_peralatan SET FAN_1 = 1 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['FAN1_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET FAN_1 = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['FAN2_ON']))            // If press ON
{
    $sql = "UPDATE data_peralatan SET FAN_2 = 1 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['FAN2_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET FAN_2 = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['FAN3_ON']))            // If press ON
{
    $sql = "UPDATE data_peralatan SET FAN_3 = 1 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['FAN3_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET FAN_3 = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

if (isset($_POST['COOLER_ON']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET COOLER = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}
if (isset($_POST['COOLER_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET COOLER = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}
if (isset($_POST['HEATER_ON']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET HEATER = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}
if (isset($_POST['HEATER_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET HEATER = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
    header('Location: ' . "http://localhost:8080/dashboard-monitoring/production/kandang-ayam.php");
    die();
}

mysqli_close($conn);
