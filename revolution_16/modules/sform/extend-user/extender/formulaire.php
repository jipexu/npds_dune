<?php
/************************************************************************/
/* SFORM Extender for NPDS USER                                         */
/* ===========================                                          */
/*                                                                      */
/* NPDS Copyright (c) 2002-2018 by Philippe Brunier                     */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/************************************************************************/
/* Dont modify this file if you dont know what you make                 */
/************************************************************************/
/* Utilise une table complémentaire de la table user : users_extend
   C1  varchar(255)
   C2  varchar(255)
   C3  varchar(255)
   C4  varchar(255)
   C5  varchar(255)
   C6  varchar(255)
   C7  varchar(255)
   C8  varchar(255)

   M1  mediumtext
   M2  mediumtext // utilisé pour les réseaux sociaux

   T1  varchar(10) date standard
   T2  varchar(14) peut stocker un TimeStamp

   B1  BLOB peut stocker des fichiers (gif, exe ...)

   ==> Le nom des champs (C1, C2, M1, T1 ...) est IMPERATIF
   ==> un formulaire valide doit contenir au moins C1 ou M1 ou T1
*/

if(!isset($C1)) $C1='';
if(!isset($C2)) $C2='';
if(!isset($C3)) $C3='';
if(!isset($C4)) $C4='';
if(!isset($C5)) $C5='';
if(!isset($C6)) $C6='';
if(!isset($C7)) $C7='';
if(!isset($C8)) $C8='';
if(!isset($T1)) $T1='';
if(!isset($T1)) $T2='';
if(!isset($M2)) $M2='';


$m->add_comment(aff_langue('<div class="row"><p class="lead">[french]En savoir plus[/french][english]More[/english][spanish]M&#xE1;s[/spanish][german]Mehr[/german]</p></div>'));

$m->add_field('C1', aff_langue('[french]Activit&#x00E9; professionnelle[/french][english]Professional activity[/english][spanish]Actividad profesional[/spanish][german]Berufliche T&#xE4;tigkeit[/german]'),$C1,'text',false,100,'','');
$m->add_extender('C1', '', '<span class="help-block"><span class="float-right" id="countcar_C1"></span></span>');

$m->add_field('C2',aff_langue('[french]Code postal[/french][english]Postal code[/english][spanish]C&#xF3;digo postal[/spanish][german]Postleitzahl[/german]'), $C2, 'text',false,5,'','');
$m->add_extender('C2', '', '<span class="help-block"><span class="float-right" id="countcar_C2"></span></span>');

//$m->add_extra('<div class="input-group date">');
$m->add_date('T1', aff_langue('[french]Date de naissance[/french][english]Birth date[/english][spanish]Fecha de nacimiento[/spanish][german]Geburtsdatum[/german]'),$T1,'date','',false,20);
$m->add_extender('T1', '','<span class="help-block">JJ/MM/AAAA</span>');
//$m->add_extra('</div>');

$m->add_extra('<div class="form-group row collapse">');
$m->add_field('M2',"R&#x00E9;seaux sociaux",$M2,'text',false);
$m->add_extra('</div>');

include('modules/geoloc/geoloc_conf.php');
$m->add_comment(aff_langue('<div class="row"><p class="lead"><a href="modules.php?ModPath=geoloc&amp;ModStart=geoloc"><i class="fa fa-map-marker fa-2x" title="[french]Modifier ou d&#xE9;finir votre position[/french][english]Define or change your geolocation[/english][chinese]Define or change your geolocation[/chinese][spanish]Definir o cambiar la geolocalizaci&#243;n[/spanish][german]Definieren oder &#xE4;ndern Sie Ihre Geolokalisierung[/german]" data-toggle="tooltip" data-placement="right"></i></a>&nbsp;[french]G&#xE9;olocalisation[/french][english]Geolocation[/english][chinese]&#x5730;&#x7406;&#x5B9A;&#x4F4D;[/chinese][spanish]Geolocalizaci&#243;n[/spanish][german]Geolokalisierung[/german]</p></div>'));
$m->add_field($ch_lat,aff_langue('[french]Latitude[/french][english]Latitude[/english][chinese]&#x7ECF;&#x5EA6;[/chinese][spanish]Latitud[/spanish][german]Breitengrad[/german]'),$$ch_lat,'text',false);
$m->add_field($ch_lon,aff_langue('[french]Longitude[/french][english]Longitude[/english][chinese]&#x7EAC;&#x5EA6;[/chinese][spanish]Longitud[/spanish][german]L&#228;ngengrad[/german]'),$$ch_lon,'text',false);

$fielddispo = array('C3','C4','C5','C6','C7','C8','M1','T2');
$geofield = array($ch_lat,$ch_lon);
$fieldrest = array_diff($fielddispo, $geofield);
reset($fieldrest);
while (list($k, $v) = each($fieldrest)) {
   $m->add_field($v,$v,'','hidden',false);
}


/*
$m->add_extra('
      <script type="text/javascript">
      //<![CDATA[
         $(document).ready(function() {
            $("<link>").appendTo("head").attr({type: "text/css", rel: "stylesheet",href: "lib/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"});

            $("#embeddingDatePicker input").datepicker({
               format: "dd/mm/yyyy",
               autoclose: "true",
               language:"'.language_iso(1,'','').'"
            })
            .on("changeDate", function(e) {
               $("#register").formValidation("revalidateField", "T1");
            })

            

         })
      //]]>
      </script>');
*/

// Si vous avez besoin des champs ci-dessous - les définir selon vos besoins - sinon les laisser en hidden
/*
$m->add_field('C3','C3','','hidden',false);
$m->add_field('C4','C4','','hidden',false);
$m->add_field('C5','C5','','hidden',false);
$m->add_field('C6','C6','','hidden',false);
// idem pour les champ Mx
$m->add_field('M1','M1','','hidden',false);
$m->add_field('T2','T2','','hidden',false);
*/
// Les champ B1 et M2 sont utilisé par NPDS dans le cadre des fonctions USERs
?>