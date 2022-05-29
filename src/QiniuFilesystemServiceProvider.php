<?php

namespace sa0chunluyu\QiniuStorage;

use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use sa0chunluyu\QiniuStorage\Plugins\DownloadUrl;
use sa0chunluyu\QiniuStorage\Plugins\ImageExif;
use sa0chunluyu\QiniuStorage\Plugins\ImageInfo;
use sa0chunluyu\QiniuStorage\Plugins\ImagePreviewUrl;
use sa0chunluyu\QiniuStorage\Plugins\PersistentFop;
use sa0chunluyu\QiniuStorage\Plugins\PersistentStatus;
use sa0chunluyu\QiniuStorage\Plugins\PrivateDownloadUrl;
use sa0chunluyu\QiniuStorage\Plugins\UploadToken;
use sa0chunluyu\QiniuStorage\Plugins\Fetch;
use sa0chunluyu\QiniuStorage\Plugins\PutFile;

/**
 * Class QiniuFilesystemServiceProvider
 * @package sa0chunluyu\QiniuStorage
 */
class QiniuFilesystemServiceProvider extends ServiceProvider
{

    public function boot()
    {
        \Storage::extend(
            'qiniu',
            function ($app, $config) {
                $qiniu_adapter = new QiniuAdapter(
                    $config['access_key'],
                    $config['secret_key'],
                    $config['bucket'],
                    $config['domain']
                );
                $file_system = new Filesystem($qiniu_adapter);
                $file_system->addPlugin(new PrivateDownloadUrl());
                $file_system->addPlugin(new DownloadUrl());
                $file_system->addPlugin(new ImageInfo());
                $file_system->addPlugin(new ImageExif());
                $file_system->addPlugin(new ImagePreviewUrl());
                $file_system->addPlugin(new PersistentFop());
                $file_system->addPlugin(new PersistentStatus());
                $file_system->addPlugin(new UploadToken());
                $file_system->addPlugin(new Fetch());
                $file_system->addPlugin(new PutFile());

                return $file_system;
            }
        );
    }

    public function register()
    {
        //
    }
}
