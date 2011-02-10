symfony propel-dump-data frontend test_data.yml
symfony propel-build-model
symfony propel-build-sql
mysql -u goatslak -D lsdjie -p < data/sql/lib.model.schema.sql
symfony clear-cache
php batch/load_data.php
