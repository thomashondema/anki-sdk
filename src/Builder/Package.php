<?php

namespace AnkiSDK\Builder;

use AnkiSDK\Models\JSONObjects\Conf;
use AnkiSDK\Models\JSONObjects\DConf;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Filesystem\Filesystem;
use function MongoDB\BSON\fromJSON;


class Package
{
    protected Capsule $capsule;

    public function getDatabase() : Capsule
    {
        return $this->capsule;
    }

    public function openDatabase(string $databaseFile){
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => $databaseFile,
            'prefix' => ''
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->capsule = $capsule;
    }

    /**
     * @param string $databaseFile
     */
    public function createDatabase(string $databaseFile): Capsule
    {
        touch($databaseFile);
        $this->openDatabase($databaseFile);

        $resolver = $this->capsule->getDatabaseManager();
        $migrationRepository = new DatabaseMigrationRepository($resolver, 'migrations');
        $migrationRepository->createRepository();
        $migrator = new Migrator($migrationRepository, $resolver, new Filesystem());

        $migrator->run([realpath(dirname(__FILE__).'/../../database/migrations')]);

        return $this->capsule;
    }

    public function seed(){


    }
}
