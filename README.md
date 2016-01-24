# http-parser
Example HTTP parser to fetch and retrieve information about remote HTML pages - application dependencies can be found in composer.json within this application.

To run the example application please use the following domain (providing php is installed your local system):

./examples/console.php http-parser:fetch:products http://url.com/you/want/to/scrape

You can also make use of the URI meta command using the following:

./examples/console.php http-parser:fetch:urimeta http://url.com/you/want/to/scrape

# Approach

Stateless commands which perform each part of the application routine as desired.

Looking for .productLister UL in the example page, link is then contained within the following selector - li div.product div.productInner div.productInfoWrapper div.productInfo h3 a

### Commands required:

* FetchProductsCommand - fetch a HTML dom page and create a set of product information and then store as a local JSON file.
* FetchUriMetaCommand - fetch a remote HTML page and return a JSON object which represents data about a URI.

### Simple domain model:

* Page - model representing our HTML page.
* Product - model representing data about a product.

Models should support [JsonSerializable interface](http://php.net/manual/en/class.jsonserializable.php) for returning data to the UI via console.

Other code:

* HttpService
** Basic service which acts as a facade to GuzzelHttp and hydrates the domain models.
* Formatter
** Service to transform the domain model in to a format which is required.