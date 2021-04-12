<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use League\Flysystem\Filesystem;
use League\Flysystem\AdapterInterface;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Cached\CachedAdapter;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Superbalist\LaravelGoogleCloudStorage\GoogleCloudStorageServiceProvider as BaseServiceProvider;

class GoogleCloudStorageServiceProvider extends BaseServiceProvider
{
    /**
     * Create a Filesystem instance with the given adapter.
     *
     * @param  \League\Flysystem\AdapterInterface $adapter
     * @param  array $config
     *
     * @return \League\Flysystem\FilesystemInterface
     */
    protected function createFilesystem(AdapterInterface $adapter, array $config)
    {
        $cache = Arr::pull($config, 'cache');

        $config = Arr::only($config, ['visibility', 'disable_asserts', 'url', 'metadata']);

        if ($cache) {
            $adapter = new CachedAdapter($adapter, $this->createCacheStore($cache));
        }

        return new Filesystem($adapter, count($config) > 0 ? $config : null);
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var \Illuminate\Filesystem\FilesystemManager $factory */
        $factory = $this->app->make('filesystem');
        $factory->extend('gcs', function ($app, $config) {
            $storageClient = $this->createClient($config);

            $bucket = $storageClient->bucket($config['bucket']);
            $pathPrefix = Arr::get($config, 'path_prefix');
            $storageApiUri = Arr::get($config, 'storage_api_uri');

            $adapter = new GoogleStorageAdapter($storageClient, $bucket, $pathPrefix, $storageApiUri);

            return $this->createFilesystem($adapter, $config);
        });
    }

    /**
     * Create a new StorageClient
     *
     * @param  mixed $config
     *
     * @return \Google\Cloud\Storage\StorageClient
     */
    private function createClient($config)
    {
        $keyFile = Arr::get($config, 'key_file');

        if ($keyFile === null) {
            return new StorageClient([
                'projectId' => $config['project_id'],
            ]);
        }

        if (is_string($keyFile)) {
            return new StorageClient([
                'projectId' => $config['project_id'],
                'keyFilePath' => $keyFile,
            ]);
        }

        if (! is_array($keyFile)) {
            $keyFile = [];
        }

        return new StorageClient([
            'projectId' => $config['project_id'],
            'keyFile' => array_merge(['project_id' => $config['project_id']], $keyFile),
        ]);
    }
}
