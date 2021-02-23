<?php

namespace AnkiSDK\Builder;

use AnkiSDK\Models\Col;
use AnkiSDK\Models\JSONObjects\Conf;
use AnkiSDK\Models\JSONObjects\DConf;
use AnkiSDK\Models\JSONObjects\Decks;
use AnkiSDK\Models\JSONObjects\Models;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Filesystem\Filesystem;
use ZipArchive;


class Package
{
    public const DATABASEFILENAME = "collection.anki2";
    const MEDIA = "media";
    protected string $packageDir;
    protected Capsule $capsule;
    protected $media = [];

    public function __construct(string $packageDir = null)
    {
        $this->packageDir = realpath($packageDir ?? $this->getTempDir());
    }

    /**
     * @param string $folder
     * @return Package
     */
    public static function fromFolder(string $folder)
    {
        $builder = new self($folder);
        $builder->load();
        return $builder;
    }

    /**
     * @param $archive
     * @return mixed
     * @throws \Exception
     */
    public static function fromArchive($archive)
    {
        $builder = new self();
        $builder->loadFromArchive($archive);
        return $archive;
    }

    /**
     * @param $archive
     * @throws \Exception
     */
    public function loadFromArchive($archive)
    {
        $zip = new ZipArchive;
        $res = $zip->open($archive);
        if ($res === TRUE) {
            $zip->extractTo($this->packageDir);
            $zip->close();
        } else {
            throw new \Exception("failed to open zipfile");
        }
        $this->load();
    }

    /**
     *
     */
    public function load()
    {
        $this->openDatabase();
        $this->loadMediaFile();
    }

    /**
     *
     */
    public function loadMediaFile()
    {
        $this->media = json_decode(file_get_contents("{$this->packageDir}/" . self::MEDIA));
    }

    /**
     * @return mixed
     */
    public function getTempDir()
    {
        $tempfile = stream_get_meta_data(tmpfile())['uri'];
        if (file_exists($tempfile)) {
            unlink($tempfile);
        }
        mkdir($tempfile);
        return $tempfile;
    }

    /**
     * @return Capsule
     */
    public function getDatabase(): Capsule
    {
        return $this->capsule;
    }

    /**
     * @param string|null $databaseFile
     * @param bool $global
     */
    public function openDatabase(string $databaseFile = null, $global = true)
    {
        $databaseFile = $databaseFile ?? $this->packageDir . self::DATABASEFILENAME;
        touch($databaseFile);

        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => $databaseFile,
            'prefix' => ''
        ]);
        if ($global) {
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }
        $this->capsule = $capsule;
    }

    /**
     * @param string $databaseFile
     */
    public function createDatabase(string $databaseFile = null): Capsule
    {
        $this->openDatabase($databaseFile);

        $resolver = $this->capsule->getDatabaseManager();
        $migrationRepository = new DatabaseMigrationRepository($resolver, 'migrations');
        $migrationRepository->createRepository();
        $migrator = new Migrator($migrationRepository, $resolver, new Filesystem());

        $migrator->run([realpath(dirname(__FILE__) . '/../../database/migrations')]);

        return $this->capsule;
    }

    /**
     *
     */
    public function seed()
    {
        $conf = (new Conf)->fromJsonString(Conf::VALIDJSON);
        $models = (new Models)->fromJsonString(Models::VALIDJSON);
        $decks = (new Decks)->fromJsonString(Decks::VALIDJSON);
        $dconf = (new DConf)->fromJsonString(DConf::VALIDJSON);

        $col = new Col();
        $col->conf = $conf;
        $col->models = $models;
        $col->decks = $decks;
        $col->dconf = $dconf;

        $col->save();
    }

    /**
     * @param string $filePath
     * @param string|null $fileName
     */
    public function addMedia(string $filePath, string $fileName = null): void
    {
        $fileName = $fileName ?? basename($filePath);
        $this->media[] = $fileName;
        $id = array_key_last($this->media);
        copy($filePath, "{$this->packageDir}/$id");
    }

    /**
     * @param string $destination
     */
    public function saveArchive(string $destination)
    {
        file_put_contents("{$this->packageDir}/" . self::MEDIA, json_encode((object)$this->media));
        $this->zipDir($destination);
    }

    /**
     * @param string $zipcreated
     * @param string $packageDir
     */
    public function zipDir(string $zipcreated, string $packageDir = null): void
    {
        $packageDir = $packageDir ?? $this->packageDir;
        $zip = new ZipArchive;
        if ($zip->open($zipcreated, ZipArchive::CREATE) === TRUE) {
            $dir = opendir($packageDir);

            while ($file = readdir($dir)) {
                if (is_file($packageDir . $file)) {
                    $zip->addFile($packageDir . $file, $file);
                }
            }
            $zip->close();
        }
    }
}
