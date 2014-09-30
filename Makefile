phpcs:
	@vendor/bin/phpcs --standard=PSR2 src tests

tests:
	@vendor/bin/phpunit --colors tests/

.PHONY: tests phpcs
