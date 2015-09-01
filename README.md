# Twinfield library for WordPress

[![Build Status](https://travis-ci.org/wp-twinfield/twinfield.svg)](https://travis-ci.org/wp-twinfield/twinfield)
[![Coverage Status](https://coveralls.io/repos/wp-twinfield/twinfield/badge.svg?branch=develop&service=github)](https://coveralls.io/github/wp-twinfield/twinfield?branch=develop)

## Environment variables

```
export TWINFIELD_USER=
export TWINFIELD_PASSWORD=
export TWINFIELD_ORGANISATION=
export TWINFIELD_OFFICE_CODE=
export TWINFIELD_ARTICLE_CODE=
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
