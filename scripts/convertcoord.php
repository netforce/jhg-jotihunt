
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta name="generator" content="PSPad editor, www.pspad.com">
    <title>Online berekening van lengte en breedte vanuit RD-coordinaten (x,y)
    </title>
      <meta name = "description" content="Online transformation of plane xy-coordinates  into WGS84 coordinates">
      <meta name = "keywords" content ="Ed Stevenhagen, Schut, javascript, coordinate system, transformation,WGS84,  ellipsoide van Bessel, coordinatensysteem rijksdriehoeksmeting, stereographic projection"    >

<link rel="stylesheet" type="text/css" href="style.css">

<script  type="text/javascript">
<!--
/*
Programma geschreven door E.Stevenhagen, Velddreef 293, 2727CH Zoetermeer
----------------------------------------------------------------------------------------------------------------------------------------
E-mail : Ed.Stevenhagen@net.HCC.nl
WWW  : http://web.inter.NL.net/HCC/Ed.Stevenhagen
De formules zijn beschreven in NGT Geodesia, juni 1992 door ir. T.G.Schut
Op 20-11-2006 aangepast door D. van Harten
- RD polaire coordinaten verwijderd,
- toevoeging presentatie wgs coordinaten in decimale graden
- toevoeging gpx waypoint file-inhoud
e-mail : dick@vanharten.info
*/
x=0;y=0;l=0,f=0;a=" ";b="  ";xx="";yy=" "
f1="0";f2="0";f3="0";gra=0;min=0;sec=0

function Grad(graden)
{
  g0 = graden
  gra = Math.floor(g0)
  g0 =(g0 - gra) * 60
  min = Math.floor(g0)
  sec =Math.round((g0 - min) * 60*1000)/1000
  if (sec==60) {min=min+1; sec=0}
  if (min==60) {gra=gra+1; min=0}
}
function Convert(obj)
{
  x=parseFloat(obj.xx.value)
  y=parseFloat(obj.yy.value)
  if (x<1000) x*=1000
  if (y<1000) y*=1000
  if (x<0 || x>290000)
    alert("De waarde van x dient te liggen tussen 0 en 290(000)")
  else
  {
    if (y<290000 || y>630000)
      alert("De waarde van y dient te liggen tussen 290(000) en 630(000)")
    else
      RDLatLong(obj,x,y)
  }
}
function RDLatLong(obj,x,y)
{
  x0  = 155000.000
  y0  = 463000.000
  f0 = 52.156160556
  l0 =  5.387638889
  a01=3236.0331637 ; b10=5261.3028966
  a20= -32.5915821 ; b11= 105.9780241
  a02=  -0.2472814 ; b12=   2.4576469
  a21=  -0.8501341 ; b30=  -0.8192156
  a03=  -0.0655238 ; b31=  -0.0560092
  a22=  -0.0171137 ; b13=   0.0560089
  a40=   0.0052771 ; b32=  -0.0025614
  a23=  -0.0003859 ; b14=   0.0012770
  a41=   0.0003314 ; b50=   0.0002574
  a04=   0.0000371 ; b33=  -0.0000973
  a42=   0.0000143 ; b51=   0.0000293
  a24=  -0.0000090 ; b15=   0.0000291
  with(Math){
    dx=(x-x0)*pow(10,-5);
    dy=(y-y0)*pow(10,-5);
    df =a01*dy + a20*pow(dx,2) + a02*pow(dy,2) + a21*pow(dx,2)*dy + a03*pow(dy,3)
    df+=a40*pow(dx,4) + a22*pow(dx,2)*pow(dy,2) + a04*pow(dy,4) + a41*pow(dx,4)*dy
    df+=a23*pow(dx,2)*pow(dy,3) + a42*pow(dx,4)*pow(dy,2) + a24*pow(dx,2)*pow(dy,4);
    f = f0 + df/3600;
    dl =b10*dx +b11*dx*dy +b30*pow(dx,3) + b12*dx*pow(dy,2) + b31*pow(dx,3)*dy;
    dl+=b13*dx*pow(dy,3)+b50*pow(dx,5) + b32*pow(dx,3)*pow(dy,2) + b14*dx*pow(dy,4);
    dl+=b51*pow(dx,5)*dy +b33*pow(dx,3)*pow(dy,3) + b15*dx*pow(dy,5);
    l = l0 + dl/3600
  }
  RdWgs84(obj,f,l)
}
function pr (f)
{
  return ((f>0.0)&&(f<10.0))?"0" + f:f;
}
function RdWgs84(obj,f,l)
{
  fWgs=f+(-96.862-11.714*(f-52)-0.125*(l-5))/100000
  lWgs=l+(-37.902+0.329*(f-52)-14.667*(l-5))/100000
  fWgs0 = fWgs
  fWgs1 = Math.floor(fWgs)
  fWgs0 =(fWgs0 - fWgs1) * 60
  fWgs2 = Math.floor(fWgs0)
  fWgs3 =Math.round((fWgs0 - fWgs2) * 60*1000)/1000
  if (fWgs3==60) {fWgs2+=1; fWgs3=0}
  if (fWgs2==60) {fWgs1+=1; fWgs2=0}
  obj.fWgs1.value=fWgs1
  obj.fWgs2.value=pr(fWgs2)
  obj.fWgs3.value=pr(fWgs3)
  obj.fWgs4.value=fWgs
  lWgs0 = lWgs
  lWgs1 = Math.floor(lWgs)
  lWgs0 =(lWgs0 - lWgs1) * 60
  lWgs2 = Math.floor(lWgs0)
  lWgs3 =Math.round((lWgs0 - lWgs2) * 60*1000)/1000
  if (lWgs3==60) {lWgs2+=1; lWgs3=0}
  if (lWgs2==60) {lWgs1+=1; lWgs2=0}
  obj.lWgs1.value=lWgs1
  obj.lWgs2.value=pr(lWgs2)
  obj.lWgs3.value=pr(lWgs3)
  obj.lWgs4.value=lWgs  

}
//-->
</script>
</head>

<body>
<form name="rd" action="">
<table>
 
  <tr>
      <td>x</td><td colspan="2"><INPUT TYPE="text" NAME="xx" SIZE=8 value="100" > km</td>
  </tr>
  <tr>
      <td>y</td><td colspan="2"><INPUT TYPE="text" NAME="yy" SIZE=8 value="500" > km</td>
  </tr>
  <tr class="odd">
      <td>&nbsp;</td><td colspan="2"><INPUT TYPE="button" Value="Converteer" onClick="Convert(this.form)">
          <INPUT TYPE="reset"  NAME="rd" Value="Reset" > </td>            
  </tr>
  <tr class="even"><td colspan="4">&nbsp;</td></tr>
  <tr class="odd">
      <td rowspan="2">WGS84 co&ouml;rdinaten</td>
      <td>lat</td>
      <td>
          <INPUT TYPE="text" NAME="fWgs1" SIZE=3 value="0"> &#176
          <INPUT TYPE="text" NAME="fWgs2" SIZE=3 value="0"> '
          <INPUT TYPE="text" NAME="fWgs3" SIZE=5 value="0"> " NB
      </td>
      <td>
          <INPUT TYPE="text" NAME="fWgs4" SIZE=9 value="0"> &#176 NB
      </td>
   </tr>
   <tr class="odd">
      <td>lon</td>
      <td>
          <INPUT TYPE="text" NAME="lWgs1" SIZE=3 value="0"> &#176  
          <INPUT TYPE="text" NAME="lWgs2" SIZE=3 value="0"> '
          <INPUT TYPE="text" NAME="lWgs3" SIZE=5 value="0"> " OL
      </td>
      <td>
          <INPUT TYPE="text" NAME="lWgs4" SIZE=9 value="0"> &#176 OL
      </td>
   </tr>
  <tr class="even"><td colspan="4">&nbsp;</td></tr>
</table>
</form>

  Stereografische projectie, Ellipso&iuml;de van Bessel 1842 , centraal punt Amersfoort: x=155000, y=463000.
  <br />NB= noorderbreedte, OL= oosterlengte.
  <br />Met dank aan <a href="http://web.inter.nl.net/hcc/Ed.Stevenhagen/groeven/geo/rdlatlon.htm">Ed Stevenhagen</a>. 
</font>  





</body>
</html>
