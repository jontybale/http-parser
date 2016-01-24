# http-parser
Example HTTP parser to fetch and retrieve information about remote HTML pages.

To run the example application please use the following domain (providing php is installed your local system):

`./examples/console.php http-parser:fetch:products http://url.com/you/want/to/scrape | python -m json.tool`

You can also make use of the URI meta command using the following:

`./examples/console.php http-parser:fetch:urimeta http://url.com/you/want/to/scrape | python -m json.tool`

Both commands can be run with a verbose -v flag to receive console output dealing the behaviour of the scrape.

`./examples/console.php http-parser:fetch:products http://url.com/you/want/to/scrape -v`

# Install

Please install the application with Composer, if you are not familiar with composer please visit [http://getcomposer.org](http://getcomposer.org).

# Unit test

Can by run via ./vendor/bin/phpunit within this directory after completing the composer install.

# Approach

Stateless commands which perform each part of the application routine as desired.

### Commands required:

* FetchProductsCommand - fetch a HTML dom page and create a set of product information and return as a JSON string to the console.
* FetchUriMetaCommand - fetch a remote HTML page and return a JSON object which represents data about a URI.

### Simple domain model:

#### Models

* *Url* - model representing our HTML meta data.
* *Product* - model representing data about a product.
* *ProductList* - model representing a set of products.
* *MoneyDecorator* - model for formatting a Money object in to a string.

Models should support [JsonSerializable interface](http://php.net/manual/en/class.jsonserializable.php) for returning data to the UI via console.

#### Services

* *HttpFetch* - Basic service which acts as a facade to GuzzelHttp and hydrates the domain models.

# To Do

# Exception handling is poor - does not handle failure well - needs to be significantly improved.
# Unit tests missing from key HttpFetch methods.
# More logging.
# More output options would be nice (to file, other formats).

