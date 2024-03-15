<?php

namespace Tests\Feature\Connections;

use Illuminate\Support\Facades\DB;

it('can connect to, insert/fetch, and delete from/to MongoDB', function () {
    $MONGO_DB_HOST = config('database.connections.mongodb.host');
    if (empty($MONGO_DB_HOST)) {
        $this->markTestSkipped('MongoDB is Not Enabled or MONGO_DB_HOST is not valid!');
    }

    $mongoDB = DB::connection('mongodb')->getMongoDB();
    $collection = $mongoDB->selectCollection('test_collection');

    $insertResult = $collection->insertOne(['foo' => 'bar']);
    $insertedId = $insertResult->getInsertedId();

    $fetchedDocument = $collection->findOne(['_id' => $insertedId]);
    expect($fetchedDocument)->not->toBeNull()
        ->and($fetchedDocument->foo)->toBe('bar');

    $deleteResult = $collection->deleteOne(['_id' => $insertedId]);
    expect($deleteResult->getDeletedCount())->toBe(1);

    $mongoDB->dropCollection('test_collection');
});

it('can connect to, insert/fetch, and delete from/to MySQL', function () {
    $MYSQL_DB_HOST = config('database.connections.mysql.host');
    if (empty($MYSQL_DB_HOST)) {
        $this->markTestSkipped('MySQL is Not Enabled or MYSQL_DB_HOST is not valid!');
    }

    $connection = DB::connection('mysql');

    $connection->statement('CREATE TABLE IF NOT EXISTS test_table (id INT AUTO_INCREMENT PRIMARY KEY, test_field VARCHAR(255))');
    $connection->table('test_table')->insert(['test_field' => 'foo']);
    $insertedId = $connection->getPdo()->lastInsertId();

    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result->test_field)->toBe('foo');

    $connection->table('test_table')->where('id', $insertedId)->delete();
    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result)->toBeNull();

    $connection->statement('DROP TABLE test_table');
});

it('can connect to, insert/fetch, and delete from/to MariaDB', function () {
    $MARIADB_HOST = config('database.connections.mariadb.host');
    if (empty($MARIADB_HOST)) {
        $this->markTestSkipped('MariaDB is Not Enabled or MARIADB_HOST is not valid!');
    }

    $connection = DB::connection('mariadb');

    $connection->statement('CREATE TABLE IF NOT EXISTS test_table (id INT AUTO_INCREMENT PRIMARY KEY, test_field VARCHAR(255))');
    $connection->table('test_table')->insert(['test_field' => 'foo']);
    $insertedId = $connection->getPdo()->lastInsertId();

    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result->test_field)->toBe('foo');

    $connection->table('test_table')->where('id', $insertedId)->delete();
    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result)->toBeNull();

    $connection->statement('DROP TABLE test_table');
});

it('can connect to, insert/fetch, and delete from/to PostgreSQL', function () {
    $PGSQL_DB_HOST = config('database.connections.pgsql.host');
    if (empty($PGSQL_DB_HOST)) {
        $this->markTestSkipped('PostgreSQL is Not Enabled or PGSQL_DB_HOST is not valid!');
    }

    $connection = DB::connection('pgsql');

    $connection->statement('CREATE TABLE IF NOT EXISTS test_table (id SERIAL PRIMARY KEY, test_field VARCHAR(255))');
    $connection->table('test_table')->insert(['test_field' => 'foo']);
    $insertedId = $connection->getPdo()->lastInsertId('test_table_id_seq');

    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result->test_field)->toBe('foo');

    $connection->table('test_table')->where('id', $insertedId)->delete();
    $result = $connection->table('test_table')->where('id', $insertedId)->first();
    expect($result)->toBeNull();

    $connection->statement('DROP TABLE test_table');
});

it('can connect to, insert/fetch, and delete from/to Local-Redis', function () {
    $REDIS_HOST = config('database.redis.default.host');
    if (empty($REDIS_HOST)) {
        $this->markTestSkipped('Local-Redis is Not Configured!');
    }

    $redis = \Illuminate\Support\Facades\Redis::connection('default');
    $redis->set('foo', 'bar');
    $result = $redis->get('foo');

    expect($result)->toBe('bar');

    $redis->del('foo');
});
