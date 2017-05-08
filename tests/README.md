# Twinfield Unit Tests

## Mocking

By default the unit tests will mock the Twinfield requests. This can be disable by
setting the environment variable `TWINFIELD_TESTS_NO_MOCK` to `true`.

```
TWINFIELD_TESTS_NO_MOCK=true phpunit
TWINFIELD_TESTS_NO_MOCK=true phpunit tests/tests/Customers/CustomerServiceTest.php
TWINFIELD_TESTS_NO_MOCK=true phpunit tests/tests/Offices/OfficeFinderTest.php
TWINFIELD_TESTS_NO_MOCK=true phpunit tests/tests/Transactions/TransactionServiceTest.php
```

```
phpunit tests/tests/Customers/CustomerServiceTest.php
phpunit tests/tests/Documents/DocumentServiceTest.php
phpunit tests/tests/GeneralLedger/GeneralLedgerServiceTest.php
phpunit tests/tests/Transactions/TransactionFinderTest.php
phpunit tests/tests/XML/Customers/CustomerSerializerTest.php
```
