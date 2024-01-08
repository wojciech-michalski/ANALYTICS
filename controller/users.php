<?php
$users=mysqli_query($kon,"SELECT users.id,users.name,users.email,users.active,groups.nazwa FROM `users` INNER JOIN `groups` ON groups.id=users.group_id WHERE 1");
$ilu=mysqli_num_rows($users);
$k=0;

