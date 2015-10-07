# Twinfield Unit Tests

## Mocking

By default the unit tests will mock the Twinfield requests. This can be disable by
setting the environment variable `TWINFIELD_TESTS_NO_MOCK` to `true`.

```
TWINFIELD_TESTS_NO_MOCK=true phpunit
TWINFIELD_TESTS_NO_MOCK=true phpunit tests/tests/Customers/CustomerServiceTest.php
```

```
phpunit tests/tests/Customers/CustomerServiceTest.php
phpunit tests/tests/XML/Customers/CustomerSerializerTest.php
```
