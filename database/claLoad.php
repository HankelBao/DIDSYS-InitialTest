<?php
/*
 *code include file
 *I: $connection
 *O: $class[], $cla_id
 */
            $result = mysqli_query($connection, 'SELECT * FROM class');
            if ($result == False) {
                die('null database');
            }
            $class = array();
            $cla_id = array();
            while ($row = mysqli_fetch_array($result)) {
                $class[] = $row['class_name'];
                $cla_id[] = $row['class_id'];
            }