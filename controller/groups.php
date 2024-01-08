<?php
$groups=mysqli_query($kon,"SELECT groups.id,groups.nazwa,groups.module_privileges,groups.active FROM `groups` WHERE 1");
$ilu=mysqli_num_rows($groups);
$k=0;

