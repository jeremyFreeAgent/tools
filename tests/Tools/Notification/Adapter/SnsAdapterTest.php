<?php
/**
 * SnsAdapterTest.php
 *
 * @date        03.07.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SnsAdapterTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\Notification\Adapter;

use Cinexpert\Tools\Notification\Adapter\SnsAdapter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class SnsAdapterTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SnsAdapterTest extends TestCase
{
    /** @var SnsAdapter */
    protected $instance;

    /** @var MockObject */
    protected $snsMock;

    public function setUp()
    {
        $this->instance = new SnsAdapter();

        $this->snsMock = $this->getMockBuilder('\Aws\Sns\SnsClient')
            ->setMethods(['publish'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->instance->setSnsClient($this->snsMock);
    }

    public function testPublish()
    {
        $topic       = 'my-topic';
        $messageBody = 'message 123';

        $this->snsMock
            ->expects($this->once())
            ->method('publish')
            ->with([
                'Message'           => $messageBody,
                'MessageAttributes' =>
                    [
                        'TopicArn' => $topic
                    ]
            ]);

        $this->instance->sendNotification($topic, $messageBody);
    }
}