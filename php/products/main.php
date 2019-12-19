<?php
$URL='http://www.theprintedstore.com';
$TITLE='The Printed Store - High Quality Minis';
$TITLEBAR='The Printed Store';
$DESCRIPTION='The Printed Store offers high quality printed miniatures for tabletop gaming.';
$IMAGE='http://www.theprintedstore.com/images/ThePrintedStore.png';
$OFFSET=150;
DocHead();
InitFavicon();
MetaInfo($URL,$TITLE,$DESCRIPTION,$IMAGE);
CssAndScripts();
TitleBar($TITLEBAR);
Carousel($xmlProducts->children(),15);

BlogSideBar($xmlArticles->children(),0);
Listing('Printed Minis',$xmlProducts->children(),"./purchasePage.php?",$OFFSET);
Listing('Components',$xmlPartner->children(),"./partner.php?",$OFFSET);
#ListingsPrintful('Linen',$products,$apiKey,$pf,$OFFSET);

Footer($OFFSET);
Scripts();
DocEnd();
?>