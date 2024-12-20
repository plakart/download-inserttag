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

namespace Plakart\DownloadInsertTagBundle\InsertTags;

use Contao\CoreBundle\DependencyInjection\Attribute\AsInsertTag;
use Contao\CoreBundle\InsertTag\Exception\InvalidInsertTagException;
use Contao\CoreBundle\InsertTag\InsertTagResult;
use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;

use Contao\Validator;
use Contao\FilesModel;
use Contao\Environment;
use Contao\Input;
use Plakart\DownloadInsertTagBundle\Helper\SendFileToBrowser;

#[AsInsertTag('download')]
class DownloadInsertTag
{
    public function __invoke(ResolvedInsertTag $insertTag): InsertTagResult
    {
        dump('hallo');
        if (null === $insertTag->getParameters()->get(0)) {
            throw new InvalidInsertTagException('Missing parameters for insert tag.');
        }

        $file = $insertTag->getParameters()->get(0);
        $title = $insertTag->getParameters()->get(1) ?? null;

        $objFile = (Validator::isUuid($file)) ? FilesModel::findByUuid($file) : FilesModel::findByPath($file);
        $url = '';
        if($objFile) {
            $url .= Environment::get('requestUri').'?file='.$objFile->path;
        }

        SendFileToBrowser::download(Input::get('file', true));

        return new InsertTagResult('<a href="'.$url.'">'.(($title) ? $title : $objFile->name).'</a>', OutputType::html);
    }
}