<?php
/**
 * Created by PhpStorm.
 * User: ZhangWB
 * Date: 2015/4/21
 * Time: 16:42
 */

namespace sa0chunluyu\QiniuStorage\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

/**
 * Class PrivateDownloadUrl
 * 得到公有资源下载地址 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->downloadUrl('foo/bar1.css'); <br>
 *
 * @package sa0chunluyu\QiniuStorage\Plugins
 */
class DownloadUrl extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'downloadUrl';
    }

    public function handle($path = null)
    {
        $location = $this->filesystem->getAdapter()->downloadUrl($path);

        return $location;
    }
}