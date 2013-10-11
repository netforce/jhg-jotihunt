Jotihunt 2013

Om de mappen een beetje overzichtelijk te houden, staat de content van de pagina's in '/inc/content/'.
De map '/scripts/' bevat enkele scripts die eventueel gebruikt zouden kunnen worden. Momenteel zijn ze niet in gebruik.
De JavaScript die in gebruik is, staat in de gebruikelijke '/js/'-map.




Installeren:

- Importeer jotihunt.sql. (Kan verwijderd worden nadat database gemaakt is.)
- Voer databasegegevens in in '/connect.php' en '/admin/connect.php'.

TODO: $baseurl in config en aanroepen
i.v.m. al dan niet subdomein, moet het volgende gecontroleerd worden:
- change .htaccess ErrorDocument url
- change /inc/top.inc.php url
- change menu.inc.php 'Home' url
- check 404.html <a href>
