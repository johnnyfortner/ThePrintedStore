<?php
include ('./php/src/functions.php');
#Vars
$xmlPartner=simplexml_load_file("./xml/partners.xml") or die("Error: Cannot create object");
$id = (int)$_GET['ID'];
$listingDetail = $xmlPartner->item[$id];

$URL='http://www.theprintedstore.com/purchasePage.php?ID='.$id;
$TITLE='The Printed Store - '.$listingDetail->title;
$DESCRIPTION=$listingDetail->description;
$IMAGE='http://www.theprintedstore.com/'.$listingDetail->images->image0;

#Parse HTML and New Line
$old = ["/n","/b","b/","c/","/c"];
$new = ["<br>","</b>","<b>","<center>","</center>"];


    function RenderThumbs($_Image,$_DataOpen,$_Title) {
		include ('./php/products/thumbnails.php');
		$DataOpen_ = $_DataOpen;
		$Image_ = $_Image;
		$Title_ = $_Title;
         }
DocHead();
InitFavicon();
MetaInfo($URL,$TITLE,$DESCRIPTION,$IMAGE);
CssAndScriptsNoFb();
TitleBar($TITLE);

echo '<div style="padding-left:2rem"><a href="./index.php">Home</a>/'.$listingDetail['category'];
echo '</div>';
#display all thumbnails

echo '<div class="row subgrid-row-1">';
echo '<div class="grid-container">';
echo '<div class="grid-x align-center">';
#	echo '    <div class="columns small-3 medium-2 large-3 end">';
foreach($listingDetail->images->children() as $items){
echo '<div class="columns small-4 medium-4 large-3 end">';
	RenderThumbs($items,$items['alt'],$listingDetail->title);
	echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row subgrid-row-1">';
echo '<div class="grid-container">';
echo '<div class="grid-x align-center">';
#echo '    <div class="columns small-12 medium-12 large-12 end">';
echo '<div class="columns medium-8 large-6">';
echo '<center><b>'.$listingDetail->title.'</b>';
echo '<p>' . str_replace($old,$new,$listingDetail->description) . '</p>';
echo str_replace($old,$new,$listingDetail->subdescription) . '<br>';
echo str_replace($old,$new,$listingDetail->subdescription['size']) . '<br>';
echo '</center>';
if($listingDetail->title['partner'] == "no")
{ 
echo 'Standard payment processor';
}
if($listingDetail->title['partner'] == "yes")
{
	echo '<center>';
	echo '<div class="image-wrapper overlay-fade-in">';
	echo '<a target="_blank" href="'.$listingDetail->partner['link'].'">';
	echo '
	<button target="_blank" href="'.$listingDetail->partner['link'].'" class="success"><img src="./images/PayPalBuyNow.png" class="hide-for-small-only"><img src="./images/PayPalBuyNowS.png" class="show-for-small-only"></button>
	</div>
	</a>';
	echo '</center>';
	echo '<br>';
}

echo '<center>';

include ('./php/products/comments.php');

#responsive IG image
echo '<a target="_blank" href="https://instagram.com/theprintedstore/">';
echo '<img src="./socialicons/webicon-instagramD.png" class="hide-for-small-only">';
echo '<img src="./socialicons/webicon-instagramS.png" class="show-for-small-only"></a>';
#responsive FB image
echo '<a target="_blank" href="https://facebook.com/havenfoundry/">';
echo '<img src="./socialicons/webicon-facebookD.png" class="hide-for-small-only">';
echo '<img src="./socialicons/webicon-facebookS.png" class="show-for-small-only">';
echo '</a><br>';

echo '</center>';
echo '</div>';
echo '</div>
	  </div>
	  </div>
	  </div>';
echo '<script src="js/jquery.min.js"></script>';
echo '<script src="js/outofview.js"></script>';
echo '<script src="js/what-input.min.js"></script>';
echo '<script src="js/foundation.min.js"></script>';
echo '<script src="js/context.js"></script>';
echo '<script>$(document).foundation();</script>';
echo '</body>';
echo '</html>';
?>
