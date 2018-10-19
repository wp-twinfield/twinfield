# Twinfield library for WordPress

[![Build Status](https://travis-ci.org/wp-twinfield/twinfield.svg)](https://travis-ci.org/wp-twinfield/twinfield)
[![Coverage Status](https://coveralls.io/repos/wp-twinfield/twinfield/badge.svg?branch=develop&service=github)](https://coveralls.io/github/wp-twinfield/twinfield?branch=develop)

## Documentation

*	[Twinfield API](https://www.twinfield.nl/api)


## Environment variables

```
export TWINFIELD_USER=
export TWINFIELD_PASSWORD=
export TWINFIELD_ORGANISATION=
export TWINFIELD_OFFICE_CODE=
export TWINFIELD_ARTICLE_CODE=
export TWINFIELD_SUBARTICLE_CODE=
export TWINFIELD_CUSTOMER_CODE=
export TWINFIELD_SALES_INVOICE_TYPE=
export TWINFIELD_SALES_INVOICE_NUMBER=
```


## Travis CI

```
travis encrypt TWINFIELD_USER=$TWINFIELD_USER --add env.global
travis encrypt TWINFIELD_PASSWORD=$TWINFIELD_PASSWORD --add env.global
travis encrypt TWINFIELD_ORGANISATION=$TWINFIELD_ORGANISATION --add env.global
travis encrypt TWINFIELD_OFFICE_CODE=$TWINFIELD_OFFICE_CODE --add env.global
travis encrypt TWINFIELD_ARTICLE_CODE=$TWINFIELD_ARTICLE_CODE --add env.global
travis encrypt TWINFIELD_CUSTOMER_CODE=$TWINFIELD_CUSTOMER_CODE --add env.global
travis encrypt TWINFIELD_SALES_INVOICE_TYPE=$TWINFIELD_SALES_INVOICE_TYPE --add env.global
travis encrypt TWINFIELD_SALES_INVOICE_NUMBER=$TWINFIELD_SALES_INVOICE_NUMBER --add env.global
```


## Debug PHP SOAP

```php
var_dump( $this->get_wsdl_url() );
var_dump( $this->soap_client->__getFunctions() );
var_dump( $this->soap_client->__getTypes() );

try {
	$test = $this->soap_client->Query( $test );
} catch ( \Exception $e ) {
	var_dump( $e );
}

echo "REQUEST:\n" . $this->soap_client->__getLastRequest() . "\n";
```


## Inspiration

*	https://github.com/KnpLabs/php-github-api
*	https://github.com/J7mbo/twitter-api-php
*	https://github.com/galen/PHP-Instagram-API
*	https://github.com/drewm/mailchimp-api
*	https://github.com/Happyr/LinkedIn-API-client
*	https://github.com/okwinza/cloudflare-api
*	https://github.com/jcroll/foursquare-api-client


## Design Patterns

*	https://en.wikipedia.org/wiki/Interpreter_pattern


## Other

*	http://www.accountingcoach.com/blog/accounts-payable-accounts-receivable
*	http://blog.fedecarg.com/2009/03/12/domain-driven-design-and-data-access-strategies/
*	http://stackoverflow.com/questions/3056447/design-pattern-for-loading-multiple-message-types
*	http://www.servicedesignpatterns.com/requestandresponsemanagement/datatransferobject
*	http://stackoverflow.com/questions/29592216/how-should-i-store-metadata-in-an-object
*	https://secure.php.net/soundex
