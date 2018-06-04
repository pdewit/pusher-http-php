<?php

class PusherChannelInfoUnitTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->pusher = new Pusher\Pusher('thisisaauthkey', 'thisisasecret', 1, true);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonChannelThrowsException()
    {
        $this->pusher->get_channel_info('my-channel:');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonChannelThrowsException()
    {
        $this->pusher->get_channel_info(':my-channel');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonNLChannelThrowsException()
    {
        $this->pusher->get_channel_info(':\nmy-channel');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonNLChannelThrowsException()
    {
        $this->pusher->get_channel_info('my-channel\n:');
    }
}
