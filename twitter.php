<?php

   /*

     Plugin Name: Sparklabs Twitter
	 Plugin URI:  http://www.sparklabs.com.mx
	 Description: Permite obtener tweets a traves de hashtags especificos.
	 Version: 1.0
	 Author: Sergio Nava & David Aguilar | Sparklabs
	 Author URI: http://www.sparklabs.com.mx 

	*/ 
	
/*********INSTALACION *****/
function twitterhash_instala(){

	global $wpdb; 
	$table_name= $wpdb->prefix . "twitterf";
    $sql = "CREATE TABLE $table_name (`id` INT NOT NULL AUTO_INCREMENT , `titulo` VARCHAR(255) NOT NULL, `subtitulo` VARCHAR(255) NOT NULL, `busqueda` VARCHAR(255) NOT NULL, `colorborde` VARCHAR(20) NOT NULL, `textoborde` VARCHAR(20) NOT NULL, `colorfondo` VARCHAR(20) NOT NULL, `textotweet` VARCHAR(20) NOT NULL, `colorenlace` VARCHAR(20) NOT NULL, `ajustar` VARCHAR(10) NOT NULL, `ancho` VARCHAR(10) NOT NULL, `alto` VARCHAR(10) NOT NULL, `sondear` VARCHAR(10) NOT NULL, `resultados` VARCHAR(10) NOT NULL, `mostraretiquetas` VARCHAR(10) NOT NULL, `mostrarfecharegistro` VARCHAR(10) NOT NULL, `mostrartoptweets` VARCHAR(10) NOT NULL, `mostraravatares` VARCHAR(10) NOT NULL, `mostrarscroll` VARCHAR(10) NOT NULL, `behavior` VARCHAR(10) NOT NULL, `intervalo` VARCHAR(10) NOT NULL, PRIMARY KEY ( `id` )) ENGINE = MyISAM;";
   	$wpdb->query($sql);
}


function twitterhash_desinstala(){
	global $wpdb; 
	$table_name= $wpdb->prefix . "twitterf";
    $sql = "DROP TABLE $table_name";
   	$wpdb->query($sql);
}


//acciones de instalación
add_action('activate_twitterhash/twitter.php','twitterhash_instala');
add_action('deactivate_twitterhash/twitter.php', 'twitterhash_desinstala');
/**EOF: INSTALACION ***/

//*******************FUNCIONES*************************************
//BACKEND:Muestra la configuracion
function flockmenu(){
	  include('template/flock.htm');
}

//FRONTEND:funcion que muestra el plugin
function mostrar_flock_twitter(){
?>

<?php 
global $wpdb; 
	$table_name= $wpdb->prefix . "twitterf";
    $result = $wpdb->get_results("SELECT  * FROM $table_name order by ID desc LIMIT 1");
	$wpdb->print_error(); 
foreach ($result as $campo)
{
  $strTitulo = $campo->titulo;
  $strSubtitulo = $campo->subtitulo;
  $strBusqueda = $campo->busqueda;
  $strColorBorde = $campo->colorborde;
  $strTextoBorde = $campo->textoborde;
  $strColorFondo = $campo->colorfondo;
  $strTextoTweet = $campo->textotweet;
  $strColorEnlace = $campo->colorenlace;
  $chkAjustar = $campo->ajustar;
  $strAncho  = $campo->ancho;
  $strAlto  = $campo->alto; 
  $chkSondear = $campo->sondear;
  $chkResultados = $campo->resultados;
  $chkMostrarEtiquetas = $campo->mostraretiquetas;
  $chkMostrarFechaRegistro = $campo->mostrarfecharegistro;
  $chkMostrarTopTweets = $campo->mostrartoptweets;
  $chkMostrarAvatares = $campo->mostraravatares;
  $chkScroll = $campo->mostrarscroll;
  $chkBehavior = $campo->behavior;
  $strIntervalo = $campo->intervalo;	
}

if($strTitulo==""){ $strTitulo = "Titulo Plugin"; }
if($strBusqueda==""){ $strBusqueda = "#sparklabs"; }
if($strSubtitulo==""){ $strSubtitulo = "Subtitulo"; }
if($strColorBorde == "") { $strColorBorde ="0324FF"; }
if($strTextoBorde == "") {  $strTextoBorde ="FFFFFF"; }
if($strColorFondo == "") {  $strTextoBorde = "FFFFFF"; }
if($strTextoTweet == "") { $strTextoTweet ="0324FF"; }
if($strColorEnlace == "") { $strColorEnlace = "1B1885"; }
if($chkAjustar == "") { $chkAjustar = false; }
if($strAncho == "") { $strAncho = "250"; }
if($strAlto == "") { $strAlto = "300"; }
if($chkSondear =="") { $chkSondear = true; }
if($chkResultados=="") { $chkResultados = true; }
if($chkMostrarEtiquetas==""){ $chkMostrarEtiquetas = true; }
if($chkMostrarFechaRegistro=="") { $chkMostrarFechaRegistro = true; }
if($chkMostrarTopTweets=="") { $chkMostrarTopTweets = true; }
if($chkMostrarAvatares=="") { $chkMostrarAvatares = true; }
if($chkScroll =="") { $chkScroll = true; }
if($chkBehavior == "") { $chkBehavior = "default"; }
if($strIntervalo == "") { $strIntervalo = "1000"; }
?>
<div title="Redes sociales, agencia de publicidad y relaciones públicas, México" class="box_twitter">
<div class="globetwitter"></div>
<script src="http://widgets.twimg.com/j/2/widget.js"></script> 
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '<?php echo $strBusqueda; ?>',
  interval: <?php echo $strIntervalo; ?>,
  title: '<?php echo $strTitulo; ?>',
  subject: '<?php echo $strSubtitulo; ?>',
  <?php if($strAncho=='auto'){ ?>
  width: '<?php echo $strAncho; ?>',
  <?php }else{ ?>
  width: <?php echo $strAncho; ?>,
  <?php } ?>
  height: <?php echo $strAlto; ?>,
  theme: {
    shell: {
      background: '#<?php echo $strColorBorde; ?>',
      color: '#<?php echo $strTextoBorde; ?>',
    },
    tweets: {
      background: '#<?php echo $strColorFondo; ?>',
      color: '#<?php echo $strTextoTweet; ?>',
      links: '#<?php echo $strColorEnlace; ?>'
    }
  },
  features: {
    scrollbar: <?php echo $chkScroll; ?>,
    loop: <?php echo $chkResultados; ?>,
    live: <?php echo $chkSondear; ?>,
    hashtags: <?php echo $chkMostrarEtiquetas; ?>,
    timestamp: <?php echo $chkMostrarFechaRegistro; ?>,
    avatars: <?php echo $chkMostrarAvatares; ?>,
    toptweets: <?php echo $chkMostrarTopTweets; ?>,
    behavior: '<?php echo $chkBehavior; ?>'
  }
}).render().start();
</script>
</div>
<?php
}
function init_mostrar_flock_twitter(){register_sidebar_widget("Twitter Hash", "mostrar_flock_twitter");}
add_action("plugins_loaded", "init_mostrar_flock_twitter");


//Muestra la configuracion
function configuracion_flocktwitter(){
	
	if(!$_POST){
	  include('template/twitterconfiguracion.php');
	}

	//procesamiento
	if($_GET["q"] == "guardar"){
	  include('template/guardar.php');
	}

}



//****************************************************************

/************************************************* menu ***********************************************************************/
//creación del menu para wordpress



//agrega menu personalizado a wordpress, para el blog flock :)
function twitterhash_add_menu(){
	
	if (function_exists('add_options_page')) {		
		//add_menu_page
		$urlk =	get_bloginfo('wpurl');		
		add_menu_page('Twitter Hash', 'Twitter Hash', 'administrator', 'flockmenu' , 'flockmenu',$urlk . '/wp-content/plugins/twitterhash/sparklabs.png');
		add_submenu_page('flockmenu','Configurar Twitter','Configurar Twitter','administrator','configuracion_flocktwitter', 'configuracion_flocktwitter');
					
	}
}

//acciones del menu
if (function_exists('add_action')) {
	add_action('admin_menu', 'twitterhash_add_menu'); 
}


?>
