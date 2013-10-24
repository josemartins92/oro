<?php

namespace Oro\Bundle\LocaleBundle\Tests\Unit\Model;

use Oro\Bundle\LocaleBundle\Model\CalendarFactory;

class CalendarFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CalendarFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->factory = new CalendarFactory($this->container);
    }

    /**
     * @dataProvider getCalendarDataProvider
     */
    public function testGetCalendar($locale)
    {
        $calendar = $this->getMock('Oro\Bundle\LocaleBundle\Model\Calendar', array('setLocale'));
        $calendar->expects($this->once())->method('setLocale')->with($locale);

        $this->container->expects($this->once())->method('get')
            ->with('oro_locale.calendar')
            ->will($this->returnValue($calendar));

        $this->assertEquals($calendar, $this->factory->getCalendar($locale));
    }

    public function getCalendarDataProvider()
    {
        return array(
            array('en_US'),
            array(null),
        );
    }
}
