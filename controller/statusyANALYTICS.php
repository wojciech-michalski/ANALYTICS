<?php

$statusy=mysqli_query($kon,"SELECT DISTINCT `status_studenta` FROM `studenci` WHERE 1");
$ilestatusow=mysqli_num_rows($statusy);

