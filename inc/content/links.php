<p>Belangrijke en handige links. Heb je zelf een handige link gevonden die in dit overzicht zou horen, geef dat dan even door.</p>

<script type="text/javascript">

(function ($) {
  // custom css expression for a case-insensitive contains()
  jQuery.expr[':'].contains = function(a,i,m){
      return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  };


  function listFilter(header, list) { // header is any element, list is an unordered list
    // create and add the filter form to the header
    var form = $("<form>").attr({"class":"filterform","action":"#"}),
        input = $("<input>").attr({"class":"filterinput","type":"text", "placeholder": "filter links"});
    $(form).append(input).appendTo(header);

    $(input)
      .change( function () {
        var filter = $(this).val();
        if(filter) {
          // this finds all links in a list that contain the input,
          // and hide the ones not containing the input while showing the ones that do
          $(list).find("a:not(:contains(" + filter + "), [data-keywords*=' " + filter + "'])").parent().slideUp();
          $(list).find("a:contains(" + filter + "), [data-keywords*='" + filter + "']").parent().slideDown();
        } else {
          $(list).find("li").slideDown();
        }
        return false;
      })
    .keyup( function () {
        // fire the above change event after every letter
        $(this).change();
    });
  }


  //ondomready
  $(function () {
    listFilter($("#searchbox"), $("[id^=links-]"));
  });
}(jQuery));


</script>
<h3>Zoeken</h3>
<div id="searchbox"></div>

<ul id="links-officieel" class="links">
	<h3>Offici&#235;le Jotihunt-links</h3>
	<li><a href="http://www.jotihunt.net/" target="_blank">Jotihunt - Spelsite</a></li>
	<li><a href="http://www.jotihunt.nl/" target="_blank">Jotihunt - Informatie</a></li>
	<li><a href="http://www.facebook.com/jotihunt" target="_blank">Jotihunt - Facebook</a></li>
	<li><a href="http://twitter.com/jotihunt" target="_blank">Jotihunt - Twitter</a></li>
</ul>


<ul id="links-converters" class="links">
	<h3>Converters</h3>
	<li><a href="http://estevenh.home.xs4all.nl/1/frame/lndex.html" 			target="_blank" data-keywords="coordinaten, converter, stevenhagen, rd, wsg84">Co&#246;rdinaten omzetten</a></li>
	<li><a href="http://www.85b.org/bra_conv.php" 								target="_blank" data-keywords="converter, cupmaat">BH-maten</a></li>
	<li><a href="http://www.tonymarston.net/php-mysql/converter.php" 			target="_blank" data-keywords="octaal, base 2, base 8, base 16, base 36">Binair / Decimaal / Hexadecimaal / Oktaal</a></li>
	<li><a href="http://geocaching.marckoppert.com/geocacheTools.php?lang=nl&page=braille" target="_blank" data-keywords="vertalen, alfabet">Braille</a></li>
	<li><a href="http://newyork.mashke.org/Conv/" 								target="_blank" data-keywords="vertalen, alfabet">Cyrillisch</a></li>
	<li><a href="http://www.digitaldutch.com/unitconverter/" 					target="_blank" data-keywords="converter, units, lengte, oppervlakte, inhoud, volume">Eenheden</a></li>
	<li><a href="http://www.colby.edu/chemistry/PChem/Hartree.html" 			target="_blank" data-keywords="converter, joule">Energie</a></li>
	<li><a href="http://geohash.org/" 											target="_blank" data-keywords="coordinaten">Geohash</a></li>
	<li><a href="http://home.hiwaay.net/~taylorc/toolbox/geography/geoutm.html" target="_blank" data-keywords="coordinaten">Geografisch / UTM Co&#246;rdinaten</a></li>
	<li><a href="http://www.translatum.gr/converter/greeklish-converter.htm" 	target="_blank" data-keywords="converter, vertalen">Grieks / Greeklish</a></li>
	<li><a href="http://www.hanidoku.com/" 										target="_blank" data-keywords="puzzel, sudoku">Hanidoku</a></li>
	<li><a href="http://www.hebcal.com/converter/" 								target="_blank" data-keywords="converter, datum">Hebreeuwse Jaartelling</a></li>
	<li><a href="http://www.bookfinder.com/" 									target="_blank" data-keywords="boeken">ISBN Database</a></li>
	<li><a href="http://www.isbn.org/converterpub.asp" 							target="_blank" data-keywords="converter, boeken">ISBN-10 / ISBN-13</a></li>
	<li><a href="http://www.web-code.org/coding-tools/javascript-escape-unescape-converter-tool.html" target="_blank" data-keywords="converter, vertalen, html, web">JavaScript (Un)Escape</a></li>
	<li><a href="http://aa.usno.navy.mil/data/docs/JulianDate.php" 				target="_blank" data-keywords="converter, kalender, datum">Juliaanse Jaartelling</a></li>
	<li><a href="http://www.fourmilab.ch/documents/calendar/" 					target="_blank" data-keywords="converter, datum">Kalenders</a></li>
	<li><a href="http://www.namesuppressed.com/kenny/" 							target="_blank" data-keywords="converter, vertalen, kenny">Kennifier (South Park)</a></li>
	<li><a href="http://nl.wikipedia.org/wiki/Bestand:Kix.png" 					target="_blank" data-keywords="converter, barcode, streepjescode">Kix-code</a></li>
	<li><a href="http://www.yellowpipe.com/yis/tools/hex-to-rgb/color-converter.php" target="_blank" data-keywords="converter, color, rgb">Kleuren</a></li>
	<li><a href="http://nl.wikipedia.org/wiki/Transpositie_(cryptografie)" 		target="_blank" data-keywords="converter, vertalen, cryptografie, geheimschrift">Kolomtranspositie</a></li>
	<li><a href="http://www.brenz.net/services/l337Maker.asp" 					target="_blank" data-keywords="converter, vertalen, cryptografie, geheimschrift">L33t (1337)</a></li>
	<li><a href="http://transition.fcc.gov/mb/audio/bickel/DDDMMSS-decimal.html" target="_blank" data-keywords="converter, coordinaten, graden">Lat-Lng / Decimaal (DDD&deg;MM'SS")</a></li>
	<li><a href="http://www.onlineconversion.com/roman_numerals_advanced.htm" 	target="_blank" data-keywords="converter, vertalen, cryptografie, geheimschrift, rekenen, wiskunde">Romeinse Cijfers</a></li>
	<li><a href="http://nl.wikipedia.org/wiki/Rozenkruisersgeheimschrift" 		target="_blank" data-keywords="converter, vertalen, cryptografie, geheimschrift">Rozenkruisercode</a></li>
	<li><a href="http://www.albireo.ch/temperatureconverter/" 					target="_blank" data-keywords="converter, celsius, fahrenheit">Temperatuur</a></li>
	<li><a href="http://www.timeanddate.com/worldclock/converter.html" 			target="_blank" data-keywords="converter, datum">Tijdzones</a></li>
	<li><a href="http://www.rishida.net/tools/conversion/" 						target="_blank" data-keywords="converter, html, ascii, hexadecimaal, utf-8, javascript, escape">Unicode</a></li>
	<li><a href="http://www.onlineconversion.com/unix_time.htm" 				target="_blank" data-keywords="converter, datum, klok">UNIX-tijd</a></li>
	<li><a href="http://www.xe.com/currencyconverter/" 							target="_blank" data-keywords="converter, geld, currency, euro, dollar">Valuta</a></li>
	<li><a href="http://www.weirdconverter.com/" 								target="_blank" data-keywords="converter, raar">Weird Converter</a></li>
</ul>

<ul id="links-overzichten" class="links">
	<h3>Overzichten van diverse converters</h3>
	<li><a href="http://www.csgnetwork.com/automotiveconverters.html" 			target="_blank" data-keywords="converter, units, eenheden">CSG-Network</a></li>
	<li><a href="http://geocaching.marckoppert.com/geocacheTools.php" 			target="_blank" data-keywords="converter, units, eenheden">Geocache-converters</a></li>
	<li><a href="http://www.wolframalpha.com/" 									target="_blank" data-keywords="converter, vertalen, rekenen, wiskunde, units, eenheden">WolframAlpha</a></li>
</ul>
