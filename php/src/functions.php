<?php
#Constants
#require_once  'php\vendor\autoload.php';
#use Printful\Exceptions\PrintfulApiException;
#use Printful\Exceptions\PrintfulException;
#use Printful\PrintfulApiClient;
#use Printful\PrintfulProducts;
#use Printful\Structures\Sync\Responses\SyncProductsResponse;
#$apiKey = 'rlmv9y27-l4c3-t6dn:9gwv-rtps2sxln0fl';
#$pf = new PrintfulApiClient($apiKey);
$xmlProducts=simplexml_load_file("./xml/products.xml") or die("Error: Cannot create object");
$xmlArticles=simplexml_load_file("./xml/articles.xml") or die("Error: Cannot create object");
$xmlPartner=simplexml_load_file("./xml/partners.xml") or die("Error: Cannot create object");
#$products = $pf->get('sync/products',['limit' => 10]);


#Functions
    function RenderProduct($Title,$Image,$Url,$Price,$D) {
		$old = ["/n","/b","b/","c/","/c"];
		$new = ["<br>","</b>","<b>","<center>","</center>"];
		echo'<div class="responsive-picture thumbnail">
		<div class="image-wrapper overlay-fade-in">
		<a href="'.$Url.'">
		<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
		<source srcset="'.$Image.'" media="(min-width: 64em)"><!--[if IE 9]></video><![endif]--><img alt="'.$Title.'" src="'.$Image.'">
		</picture>
		</a>
		</div>
		</div>
		<center>
		<a href="'.$Url.'">
		<span class="heading-text-2"><strong class="heading-text-3">'.$Title.'</strong></span>
		</a>
		<span class="heading-text-1"><small>'.$Price.'</small></span><br>
		'.str_replace($old,$new,$D).'
		<div style="width:72%;">
		<a href="'.$Url.'" class="button hollow tiny expanded" style="border-radius:4px;">Buy Now</a></div>
		</center>';
	}
		 
    function RenderArticle($Title,$Image,$Url,$D) {
		$old = ["/n","/b","b/","c/","/c"];
		$new = ["<br>","</b>","<b>","<center>","</center>"];
		echo'<div class="responsive-picture thumbnail" >
		<div class="image-wrapper overlay-fade-in">
		<a href="'.$Url.'">
		<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
		<source  srcset="'.$Image.'" media="(min-width: 64em)"><!--[if IE 9]></video><![endif]--><img alt="'.$Title.'" src="'.$Image.'">
		</picture>
		</a>
		</div>
		</div><center>
		<a href="'.$Url.'">
		<span class="heading-text-2"><strong class="heading-text-3">'.$Title.'</strong></span><br>
		</a>'.str_replace($old,$new,$D).'
		<div style="width:72%;">
		<a href="'.$Url.'" class="button hollow tiny expanded" style="border-radius:4px;">Read More</a></div>
		</center>';
	}
	
	function ParseBBCode($I){
	#Parse HTML and New Line
	$old = ["/n","/b","b/","c/","/c"];
	$new = ["<br>","</b>","<b>","<center>","</center>"];	
	echo str_replace($old,$new,$I);
	#return;
	}
	
	function DocHead(){
		echo ' <!DOCTYPE html><head>';
	}
		 
	function InitFavicon(){
		echo ' <link rel="apple-touch-icon" sizes="180x180" href="./images/ThePrintedStore.png">
			<link rel="icon" type="image/png" href="./images/ThePrintedStoreS.png" sizes="64x64">
			<link rel="icon" type="image/png" href="./images/ThePrintedStoreSC.png" sizes="32x32">
			<link rel="icon" type="image/png" href="./images/ThePrintedStoreSC16.png" sizes="16x16">';
	}
	
	function MetaInfo($url,$title,$description,$image){
		echo '<meta name="theme-color" content="#ffffff">
			  <meta charset="utf-8">';
		echo '<meta name="viewport" content="width=device-width,initial-scale=1">';
		echo '<meta name="description" content="'.$description.'">';
		echo '<title>'.$title.'</title>';
		echo '<meta property="og:url" content="'.$url.'" />';
		echo '<meta property="og:type" content="website" />';
		echo '<meta property="og:title" content="'.$title.'" />';
		echo '<meta property="og:description" content="'.$description.'" />';
		echo '<meta property="og:image" content="'.$image.'" />';
	}
	
	function CssAndScripts(){
		echo '<link rel="stylesheet" href="css/foundation.css">';
		echo '<link rel="stylesheet" href="css/wireframe-theme.min.css">';
		echo '<script>document.createElement( "picture" );</script>';
		echo '<script class="picturefill" async="async" src="js/picturefill.min.js"></script>';
		echo '<link rel="stylesheet" href="css/main.css">';
		echo '<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;';
		echo 'js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";';
		echo "fjs.parentNode.insertBefore(js, fjs);";
		echo "}(document, 'script', 'facebook-jssdk'));</script>";
		echo '</head>';
	}
	
	function CssAndScriptsNoFb(){
		echo '<link rel="stylesheet" href="css/foundation.css">';
		echo '<link rel="stylesheet" href="css/wireframe-theme.min.css">';
		echo '<script>document.createElement( "picture" );</script>';
		echo '<script class="picturefill" async="async" src="js/picturefill.min.js"></script>';
		echo '<link rel="stylesheet" href="css/main.css">';
		echo '</head>';
	}
	
	function TitleBar($Title){
		echo '<body class="no-js">';
		echo '<div class="subgrid subgrid-1">';
		echo '<div class="row subgrid-row-2">';
		echo '<div class="columns small-12 callout primary large-12 large-offset-0">';
		echo '<div class="container headingContainer">';
		echo '<center><h1><u><b>'.$Title.'</b></u></h1>';
		echo '<a href="/index.php">Home</a> | <a href="/blog.php">Blog</a>';
		echo '</center>';
		echo '</div>';
		echo '</div>';
		echo '</div>';	
	}

	function Carousel($Featured,$Offset){
		echo '<center>
		<div style="
		border-radius: 16px;
		max-width: 75rem;
		position: relative;
		bottom: '.$Offset.'px;
		background-image:linear-gradient(0deg, rgba(227, 244, 255, 0) 0%, rgba(207, 222, 232, 0.3) 33%, rgba(207, 222, 232, 1) 66%, rgba(207, 222, 232, 1) 100%);">';
		echo '<div style="
		max-width: 45rem;" 
		class="orbit" role="region" aria-label="Featured Products" data-orbit>
		<ul class="orbit-container">
		<button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
		<button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>';
			foreach($Featured as $items){
				echo '<li class="orbit-slide">';
				echo '<div class="show-for-medium" style="
				height:685px;
				background-image:linear-gradient(0deg, rgba(227, 244, 255, 1) 0%, rgba(207, 222, 232, 0.3) 33%, rgba(207, 222, 232, 0) 75%, rgba(207, 222, 232, 1) 100%),
				url('.$items->images->image0.');">
				</div>
				<div class="show-for-small-only">
				<img src="'.$items->images->image0.'" style="
				border-radius:16px;"></div>';
				echo'
				</li>';
			}
		echo '</div></center>';
	}
	
	function BlogSideBar($Articles,$Offset){
		#echo '<div class="row subgrid-row-1" style="position: relative;bottom: '.$Offset.'px;">';
		#echo '<div class="grid-container">';
		echo '<div class="grid-x align-left hide-for-large-only hide-for-medium-only hide-for-small-only" style="position:absolute;;" ">';
		echo '<div class="columns small-4 medium-3 large-2 end">';
		echo '<center><b><u>Learning Center</u></b></center>';
			foreach($Articles as $items){
				#echo '<div class="columns small-4 medium-4 large-2 end">';
				RenderArticle($items->title,$items->thumbnail,$items->partner['link'],substr($items->paragraphs->p1, 0, 180).'...');
				#echo '</div>';
				
			}
		#echo '</div>';
		#echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	
	function Blog($Title,$Articles,$Offset){
		echo '<div class="row subgrid-row-1" style="position: relative;bottom: '.$Offset.'px;">';
		echo '<center><b><u>'.$Title.'</u></b></center>';
		echo '<div class="grid-container">';
		echo '<div class="grid-x auto align-center">';
			foreach($Articles as $items){
				echo '<div class="columns small-4 medium-3 large-3 end">';
				RenderArticle($items->title,$items->thumbnail,$items->partner['link'],substr($items->paragraphs->p1, 0, 180).'...');
				echo '</div>';
			}
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	
	function Listing($Title,$Products,$Page,$Offset){
		echo '<div class="row subgrid-row-1" style="position: relative;bottom: '.$Offset.'px;">';
		echo '<center><b><u>'.$Title.'</u></b></center>';
		echo '<div class="grid-container">';
		echo '<div class="grid-x auto align-center">';
		$j=0;
			foreach($Products as $items){
				$Url = "ID=".$j;
				echo '<div class="columns small-4 medium-3 large-3 end">';
				RenderProduct($items->title,$items->thumb,$Page.$Url,$items->price,substr($items->description, 0, 140).'...');
				echo '</div>';
				++$j;
			}
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	
/*	function ListingsPrintful($Title,$Linen,$ApiKey,$Pf,$Offset){
		echo '<div class="row subgrid-row-1" style="position: relative;bottom: '.$Offset.'px;">';
		echo '<center><b><u>'.$Title.'</u></b></center>';
		echo '<div class="grid-container">';
		echo '<div class="grid-x align-center">';
		$apiKey = $ApiKey;
		$pf = $Pf;
			foreach($Linen as $items){
				$info = $pf->get('sync/products/@'.$items[external_id]);
				echo '<div class="columns small-4 medium-3 large-3 end">';
				$Url = "ID=".$info[sync_product][id];
				RenderProduct($info[sync_product][name],$info[sync_variants][0][files][1][thumbnail_url],"./merch.php?".$Url,'$'.$info[sync_variants][0][retail_price],substr($info[sync_variants][0][product][name],0,140).'...');
				echo '</div>';
				
			}
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}*/
	
	function Footer($Offset){
		echo'<div style="position: relative;bottom: '.$Offset.'px;">';
		include('./DisplayViews.php');
		echo'<center>';
		echo'<div class="fb-share-button" 
			data-href="http://www.theprintedstore.com" 
			data-layout="button_count">
			</div><br>';
		#responsive IG/FB image
		echo'<a target="_blank" href="https://instagram.com/theprintedstore/">';
		echo'<img src="./socialicons/webicon-instagramD.png" class="hide-for-small-only">';
		echo'<img src="./socialicons/webicon-instagramS.png" class="show-for-small-only">';

		echo'</a><a target="_blank" href="https://facebook.com/havenfoundry/">';
		echo'<img src="./socialicons/webicon-facebookD.png" class="hide-for-small-only">';
		echo'<img src="./socialicons/webicon-facebookS.png" class="show-for-small-only">';
		echo'</a><br>';
		echo'</center>';
		echo'</div></div>
			</div>
			</div>
			</div>';
	}
	
	function Scripts(){
		echo '<script src="js/jquery.min.js"></script>';
		echo '<script src="js/outofview.js"></script>';
		echo '<script src="js/what-input.min.js"></script>';
		echo '<script src="js/foundation.min.js"></script>';
		echo '<script src="js/context.js"></script>';
		echo '<script>$(document).foundation();</script>';
	}
	
	function DocEnd(){
		echo '</body></html>';
	}
	
?>