# ThePrintedStore
This was the original sales page for a long dead print on demand project
## ThePrintedStore Website PHP
Responsive Web Store/Blog written in Php and foundation responsive front-end, that procedurally generates each page based on xml data as a product database and any items you have on printful. uses xml parsing as an item listing system, you can also list affiliate products with their partner tracking/purchase link and mix them in with your own products. has functions for printful api integration 
### Mostly everything is in:
- php/products/main.php
- php/src/functions.php
- /purchasePage.php `this is where you put your custom payment processor`
- /partner.php
- /blog.php
- products/articles/partners are stored in /xml/

The printful api uses composer, so if something seems missing(vendor), it is. 

The printful functions I made are commented out for this reason.
