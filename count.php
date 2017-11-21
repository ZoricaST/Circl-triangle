 <html>
<body>

<?php

 $x1 = $y1 = $x2 = $y2 = $x3 =$y3=$p=$q=$r= 0;$i=1;
/*Ispituje da li je unos bio regularan*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $x1 = test_input($_POST["x1"]);
   $y1 = test_input($_POST["y1"]);
   $x2 = test_input($_POST["x2"]);
   $y2 = test_input($_POST["y2"]);
   $x3 = test_input($_POST["x3"]);
   $y3 = test_input($_POST["y3"]);
   $p = test_input($_POST["p"]);
   $q = test_input($_POST["q"]);
   $r = test_input($_POST["r"]);
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/*Ispisuje na ekranu unete podatke*/
echo "You have entered the coordinates of the triangle ";
echo "A(" .$x1.",". $y1.")";
echo ", B(" .$x2.",". $y2.")";
echo ", C(" .$x3.",". $y3.")";
echo "<br>Coordinates of the center S(p,q) of the circle:  ";
echo " S(" .$p.",". $q.")";
echo ",and the radius: r=" .$r;

/*Ispituje da li su unete tacke nekolinearne, jer ako su kolinearne one ne cine trougao*/
//funkcija izracunava rastojanje izmedju dve tacke
function rastojanje_2tacke($x1,$y1,$x2,$y2) {
  $data = sqrt(pow(($x1-$x2),2)+pow(($y1-$y2),2));
  return $data;
}

//Duzina stranice c
echo "<br>The side c= d(A,B)= ";
$c=rastojanje_2tacke($x1,$y1,$x2,$y2);
echo $c;
//Duzina stranice b
echo "<br>The side b= d(A,C)= ";
$b=rastojanje_2tacke($x1,$y1,$x3,$y3);
echo $b;
//Duzina stranice a
echo "<br>The side a= d(B,C)= ";
$a=rastojanje_2tacke($x2,$y2,$x3,$y3);
echo $a;
//ispitivanje da li je zbir 2 stranice veci od trece
if($a+$b>$c and $a+$c>$b and $b+$c>$a){
    echo "<br>These three  points make the triangle - They are noncollinear!";
}
 else {
	 echo "<br>These three points can not be verteces of a triangle - They are collinear!";  
     echo'<a href="krug.php" >Please enter some other points</a>';
 }
//Ispituje da li centar kruga S u oblasti pravougaonika kome pripada trougao
//prvo malazi maximume i minimume koordinata trougla
 $max_x=max($x1,$x2,$x3);
 $max_y=max($y1,$y2,$y3);
 
 $min_x=min($x1,$x2,$x3);
 $min_y=min($y1,$y2,$y3);
 echo "<br>The minimum of x-coordinate is minx = ".$min_x." and the maximum of x - coordinates is ".$max_x;
 echo "<br>The minimum of y-coordinates is miny = ".$min_y. " and the maximum of y - coordinates is ". $max_y;
 
if($min_x<$p and $p<$max_x){
    echo "<br>the coordinate p is in the triangular area!";
}
 else {$i=0;
	 echo "<br>The center of the circle is not in the triangular area, since p is not in the triangular area!";  
     echo'<a href="krug.php" >Please enter some other points</a>';
 }
 if($min_y<$q and $q<$max_y){
    echo "<br>q is in the triangular area!";
}
 else {$i=0;
	 echo "<br>The center of the circle is not in the triangular area, since q is not in the triangular area!!";  
     echo'<a href="krug.php" >Please enter some other points</a>';
 }
 
//Pravi jednacine stranica
function jednacina_2tacke_k($x1,$y1,$x2,$y2) {
	if($x2-$x1==0 ){$k=0;}
  else {$k = ($y2-$y1)/($x2-$x1);}
   return $k ;}
 
function jednacina_2tacke_n($x1,$y1,$x2,$y2) {
	if($x2-$x1==0 ){$k=0;}
  else {$k = ($y2-$y1)/($x2-$x1);}
  $n=$y1-$k*$x1;
   return $n ;}
 

$kab=jednacina_2tacke_k($x1,$y1,$x2,$y2);
$nab=jednacina_2tacke_n($x1,$y1,$x2,$y2);
if($x2-$x1==0 ){echo '<br>The equation of the line AB is: x ='.$x1;}
	else {$xec=($q-$nab)/$kab;echo "<br>The equation of the line AB is: y= ".$kab."x + ".$nab; }
	

	
$kac=jednacina_2tacke_k($x1,$y1,$x3,$y3);
$nac=jednacina_2tacke_n($x1,$y1,$x3,$y3);
if($x3-$x1==0 ){echo '<br>The equation of the line  AC is: x ='.$x1;}
	else {$xeb=($q-$nac)/$kac;echo "<br>The equation of the line  AC is: y= ".$kac."x + ".$nac; }	
	

$kcb=jednacina_2tacke_k($x2,$y2,$x3,$y3);
$ncb=jednacina_2tacke_n($x2,$y2,$x3,$y3);
if($x3-$x2==0 ){echo '<br>The equation of the line  BC is: x ='.$x2;}
	else { $xea=($q-$ncb)/$kcb;echo "<br>The equation of the line   BC is : y= ".$kcb."x + ".$ncb; }
	
if ($min_x>$xea or $xea>$max_x){$xp1=$xeb;$xp2=$xec;}
 elseif ($min_x<$xeb and $xeb<$max_x){$xp1=$xea;$xp2=$xeb;}		
	else{$xp1=$xea;$xp2=$xec;}
if(min($xp1,$xp2)<$p and max($xp1,$xp2)>$p and $i>0){echo "<br>The center of the circle is in the triangle area";}
else {echo "<br>The center of the circle is not in the triangular area!";}


//Ispituje da li je prava AC ima presecne tacke sa krugom
$a=-2*$p; $b=-2*$q; $c=$p*$p+$q*$q-$r*$r;
$a1=1+$kac*$kac;$a2=1+$kab*$kab;$a3=1+$kcb*$kcb;
$b1=2*$kac*$nac+$a+$b*$kac;$b2=2*$kab*$nab+$a+$b*$kab;$b3=2*$kcb*$ncb+$a+$b*$kcb;
$c1=$nac*$nac+$b*$nac+$c;$c2=$nab*$nab+$b*$nab+$c;$c3=$ncb*$ncb+$b*$ncb+$c;
$d1=$b1*$b1-4*$a1*$c1;$d2=$b2*$b2-4*$a2*$c2;$d3=$b3*$b3-4*$a3*$c3;
echo '<br>The equation of the circle  in canonical form is: (x-'.$p.')**2+(y-'.$q.')**2 = '.$r*$r;
echo '<br>The equation of the circle  in general form is: x**2+y**2+'.$a.'*x+'.$b.'y + '.$c.'=0';
echo "<br>The equation of the line AC is: y= ".$kac."x + ".$nac;
echo '<br>The quadratic equation coefficients witch are the solution of the system: a='.$a1.', b='.$b1.' , c= '.$c1;

echo "<br>The equation of the line AB is: y= ".$kab."x + ".$nab;
echo '<br>The quadratic equation coefficients witch are the solution of the system: a='.$a2.', b='.$b2.' , c= '.$c2;

echo "<br>The equation of the line BC is: y= ".$kcb."x + ".$ncb;
echo '<br>The quadratic equation coefficients witch are the solution of the system: a='.$a3.', b='.$b3.' , c= '.$c3;
if($d1>=0){echo '<br>The circle intersects the sides of the triangle and is not entirely in the triangle area';echo'  <a href="krug.php" >Please enter some other points</a>';}
elseif($d2>=0){echo '<br>The circle intersects the sides of the triangle and is not entirely in the triangle area';echo'  <a href="krug.php" >Please enter some other points</a>';}
 else {if($d3>=0) {echo '<br>The circle intersects the sides of the triangle and is not entirely in the triangle area,';echo'  <a href="krug.php" >Please enter some other points</a>';}else{echo'<br>The whole circle is in triangle';}}
 

//Ispituje da li je prava AB ima presecne tacke sa krugom


?>

</body>
</html> 