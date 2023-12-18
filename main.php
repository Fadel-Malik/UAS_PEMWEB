<?php
include "connectDB.php";

if ($conn) {
    echo "Berhasil Terhubung ke database!";
} else {
    echo "database tidak terhubung";
}


