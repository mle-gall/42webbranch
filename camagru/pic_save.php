<?php
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
echo $img."<br />";
$data = base64_decode($img);
$file = 'uploads/untreated_pics/'.date("YmdHis").'.png';

if (file_put_contents($file, $data)) {
   echo "<p>The canvas was saved as $file.</p>";
} else {
   echo "<p>The canvas could not be saved.</p>";
}
?>
