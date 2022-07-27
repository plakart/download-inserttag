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

namespace Plakart\DownloadInsertTagBundle\Helpers;

use Contao\Controller;

class SendFile {
    public static function download($param)
    {
        if($param) {
            Controller::sendFileToBrowser($param);
        }
    }
}