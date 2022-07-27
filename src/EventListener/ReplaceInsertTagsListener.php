<?php

declare(strict_types=1);

/*
 * This file is part of Download-Insert-Tag Bundle.
 *
 * (c) plakart GmbH & Co.KG (https://plakart.de)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plakart\DownloadInsertTagBundle\EventListener;

use Contao\FilesModel;
use Contao\Environment;
use Contao\Controller;
use Contao\System;
use Contao\Validator;
use Contao\Input;
use Plakart\DownloadInsertTagBundle\Helpers\SendFile;

class ReplaceInsertTagsListener
{
    /*
     * Insert-tag should be: {{download::path|uuid::linkname}}
     */
    protected string $link;
    public function onReplaceInsertTags(string $tag, bool $useCache, $cacheValue, array $flags)
    {
        $elements = explode('::', $tag);
        $key = strtolower($elements[0]);
        $path = $elements[1];
        if(isset($elements[2])) {
            $name = $elements[2];
        } else {
            $name = false;
        }

        if('download' === $key) {
            $url = Environment::get('request').'?file=';
            // check whether $value is path or uuid
            if(Validator::isUuid($path)) {
                $file = FilesModel::findByUuid($path);
                $url .= $file->path;
                if(!$name) {
                    $name = $file->path;
                }
            } else {
                $url .= $path;
                if(!$name) {
                    $name = $path;
                }
            }

            $this->link = '<a href="'.$url.'">'.$name.'</a>';

            $file = Input::get('file', true);
            SendFile::download($file);

            return $this->link;
        }

        return false;
    }
}