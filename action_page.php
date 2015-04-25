Hi 
<?php 
$app->request()->post('firstname');
echo htmlspecialchars($_POST['firstname']); 
?> 

<?php 
echo htmlspecialchars($_POST['lastname']); 
?>.



You are from 
<?php
echo (int)$_POST['state']; 
?>.