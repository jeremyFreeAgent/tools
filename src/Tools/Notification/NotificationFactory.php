<?php
/**
 * NotificationFactory.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        NotificationFactory.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class NotificationFactory
 *
 * @package     Cinexpert  
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class NotificationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $notification = new \Cinexpert\Tools\Notification\Notification();
        $notification->setAdapter($container->get('notification.adapter.sns'));

        return $notification;
    }
}