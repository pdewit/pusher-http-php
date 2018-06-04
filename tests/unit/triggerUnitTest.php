<?php

class PusherTriggerUnitTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->pusher = new Pusher\Pusher('thisisaauthkey', 'thisisasecret', 1, true);
        $this->eventName = 'test_event';
        $this->data = array();
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonChannelThrowsException()
    {
        $this->pusher->trigger('my-channel:', $this->eventName, $this->data);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonChannelThrowsException()
    {
        $this->pusher->trigger(':my-channel', $this->eventName, $this->data);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonNLChannelThrowsException()
    {
        $this->pusher->trigger(':\nmy-channel', $this->eventName, $this->data);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonNLChannelThrowsException()
    {
        $this->pusher->trigger('my-channel\n:', $this->eventName, $this->data);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testChannelArrayThrowsException()
    {
        $this->pusher->trigger(array('this_one_is_okay', 'my-channel\n:'), $this->eventName, $this->data);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel:', $this->eventName, $this->data, '1.1:');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel:', $this->eventName, $this->data, ':1.1');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testLeadingColonNLSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel:', $this->eventName, $this->data, ':\n1.1');
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testTrailingColonNLSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel:', $this->eventName, $this->data, '1.1\n:');
    }

    public function testNullSocketID()
    {
        // Check this does not throw an exception
        $this->pusher->trigger('my-channel', $this->eventName, $this->data, null);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testFalseSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel', $this->eventName, $this->data, false);
    }

    /**
     * @expectedException \Pusher\PusherException
     */
    public function testEmptyStrSocketIDThrowsException()
    {
        $this->pusher->trigger('my-channel', $this->eventName, $this->data, '');
    }
}
