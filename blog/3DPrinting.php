<?php
#Vars
$xmlArticles=simplexml_load_file("../xml/articles.xml") or die("Error: Cannot create object");
$listingDetail = $xmlArticles->item[1];

    function RenderThumbs($_Image,$_DataOpen,$_Title) {
		include ('../php/products/thumbnails.php');
		$DataOpen_ = $_DataOpen;
		$Image_ = $_Image;
		$Title_ = $_Title;
         }

echo ' <!DOCTYPE html>    <head>';
echo '<link rel="apple-touch-icon" sizes="180x180" href="../images/ThePrintedStore.png">
<link rel="icon" type="image/png" href="../images/ThePrintedStoreS.png" sizes="64x64">
<link rel="icon" type="image/png" href="../images/ThePrintedStoreSC.png" sizes="32x32">
<link rel="icon" type="image/png" href="../images/ThePrintedStoreSC16.png" sizes="16x16">
<meta name="theme-color" content="#ffffff">';
echo '	  <meta charset="utf-8">';
echo '	  <meta name="viewport" content="width=device-width,initial-scale=1">';
echo '	  <meta name="description" content="'.$listingDetail->paragraphs->p1 .'">';
echo '	  <title>ThePrintedStore '.$listingDetail->title .'</title>';
echo '	  <link rel="stylesheet" href="../css/foundation.css">';
echo '	  <link rel="stylesheet" href="../css/wireframe-theme.min.css">';
echo '	  <script>document.createElement( "picture" );</script>';
echo '	  <script class="picturefill" async="async" src="../js/picturefill.min.js"></script>';
echo '	  <link rel="stylesheet" href="../css/main.css">';
echo '	  </head>';
		echo '<body class="no-js">';
		echo '<div class="subgrid subgrid-1">';
		echo '<div class="row subgrid-row-2">';
		echo '<div class="columns small-12 callout primary large-12 large-offset-0">';
		echo '<div class="container headingContainer">';
		echo '<center><h1><u><b>' . 'The Printed Store - '.$listingDetail->title . '</b></u></h1>';
		echo '<a href="/index.php">Home</a> | <a href="/blog.php">Blog</a>';
		echo '</center>';
		echo '</div>';
		echo '</div>';
		echo '</div>';	
#echo '<div style="padding-left:2rem"><a href="../index.php">Home</a>/Blog';
#echo '</div>';

#display all thumbnails

echo '<div class="row subgrid-row-1">';
echo '<div class="grid-container">';
echo '<div class="grid-x align-center">';
foreach($listingDetail->images->children() as $items){
	echo '<div class="columns small-4 medium-4 large-3 end">';
	RenderThumbs($items,$items['alt'],$listingDetail->title);
	echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';

#display all paragraphs

echo '<div class="row subgrid-row-1">';
echo '<div class="grid-container">';
echo '<div class="grid-x align-center">';
echo '<div class="columns medium-8 large-6">';
echo '<center><b>'. $listingDetail->title . '</b></center>';
foreach($listingDetail->paragraphs->children() as $items){
	echo '<center>';
	echo '<p>';
	echo $items;
	echo '</p>';
	echo '</center>';
}

#display external links

#echo '<a href="' .$xmlArticles->item[1]->external . '">'.$xmlArticles->item[1]->external['alt'].'</a>';

echo '<center>';

include ('../php/products/comments.php');
#responsive IG image
echo '<a target="_blank" href="https://instagram.com/theprintedstore/">';
echo '<img src="../socialicons/webicon-instagramD.png" class="hide-for-small-only">';
echo '<img src="../socialicons/webicon-instagramS.png" class="show-for-small-only"></a>';
#responsive FB image
echo '<a target="_blank" href="https://facebook.com/havenfoundry/">';
echo '<img src="../socialicons/webicon-facebookD.png" class="hide-for-small-only">';
echo '<img src="../socialicons/webicon-facebookS.png" class="show-for-small-only">';
echo '</a><br>';

echo '</center>';
echo '</div>';
echo '</div>
	  </div>
	  </div>
	  </div>';
echo '<script src="../js/jquery.min.js"></script>';
echo '<script src="../js/outofview.js"></script>';
echo '<script src="../js/what-input.min.js"></script>';
echo '<script src="../js/foundation.min.js"></script>';
echo '<script src="../js/context.js"></script>';
echo '<script>$(document).foundation();</script>';
echo '</body>';
echo '</html>';
?>
