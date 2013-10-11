<!--
/*
Programma geschreven door E.Stevenhagen, Velddreef 293, 2727CH Zoetermeer
----------------------------------------------------------------------------------------------------------------------------------------
E-mail : Ed.Stevenhagen@net.HCC.nl
WWW  : http://web.inter.NL.net/HCC/Ed.Stevenhagen
De formules zijn beschreven in NGT Geodesia, juni 1992 door ir. T.G.Schut
*/
x=0;y=0;l=0,f=0;a=" ";b="  ";xx="";yy=" "
f1="0";f2="0";f3="0";gra=0;min=0;sec=0

function ConvertToRD(obj, inline){
	if(inline && obj.getElementsByTagName('a')[0].innerHTML.substr(0,2) == "RD") return;
	f=parseFloat(obj.getElementsByTagName('a')[0].innerHTML.substr(0,obj.getElementsByTagName('a')[0].innerHTML.indexOf(' ')));
	l=parseFloat(obj.getElementsByTagName('a')[0].innerHTML.substr(obj.getElementsByTagName('a')[0].innerHTML.indexOf(' ')+1));
	fWgs = f - (-96.862 - 11.714 * (f - 52) - 0.125 * (l - 5)) / 100000;
	lWgs = l - (-37.902 +  0.329 * (f - 52) -14.667 * (l - 5)) / 100000;
	LatLongRD(obj,fWgs,lWgs, inline);
}
function LatLongRD(obj, f, l, inline){
	x0  = 155000.00;
	y0  = 463000.00;

	f0 = 52.15616056;
	l0 =  5.38763889;

	c01=190066.98903 ;  d10=309020.31810;
	c11=-11830.85831 ;  d02=  3638.36193;
	c21=  -114.19754 ;  d12=  -157.95222;
	c03=   -32.38360 ;  d20=    72.97141;
	c31=    -2.34078 ;  d30=    59.79734;
	c13=    -0.60639 ;  d22=    -6.43481;
	c23=     0.15774 ;  d04=     0.09351;
	c41=    -0.04158 ;  d32=    -0.07379;
	c05=    -0.00661 ;  d14=    -0.05419;
						d40=    -0.03444;
	df=(f - f0) * 0.36;
	dl=(l - l0) * 0.36;

	with(Math){
		dx =c01*dl + c11*df*dl + c21*pow(df,2)*dl + c03*pow(dl,3);
		dx+=c31*pow(df,3)*dl + c13*df*pow(dl,3) + c23*pow(df,2)*pow(dl,3);
		dx+=c41*pow(df,4)*dl + c05*pow(dl,5);
		x=x0 + dx;
		//x=round(100*x)/100;
		x=round(x);
	}

	with(Math){
		dy =d10*df + d20*pow(df,2) + d02*pow(dl,2) + d12*df*pow(dl,2);
		dy+=d30*pow(df,3) + d22*pow(df,2)*pow(dl,2) + d40*pow(df,4);
		dy+=d04*pow(dl,4) + d32*pow(df,3)*pow(dl,2) + d14*df*pow(dl,4);
		y=y0 + dy;
		y=round(y);
	}
	if(inline){
		obj.getElementsByTagName('a')[0].innerHTML = 'RD: ' + x + ' ' + y;
	}else{
		obj.getElementsByTagName('span')[0].innerHTML = 'RD: ' + x + ' ' + y;
		obj.getElementsByTagName('span')[0].style.display = "block";
	}
}
function hideTooltip(id){
	id.getElementsByTagName('span')[0].style.display = 'none';
}


//-->