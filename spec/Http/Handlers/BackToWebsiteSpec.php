<?php

namespace spec\App\Http\Handlers;

use App\Http\Handlers\BackToWebsite;
use Illuminate\Container\Container;
use Orchestra\Contracts\Foundation\Foundation;
use Orchestra\Widget\Handlers\Menu;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BackToWebsiteSpec extends ObjectBehavior
{
    function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BackToWebsite::class);
    }

    function it_can_be_display_when_is_installed(Container $app, Foundation $foundation, Menu $menu)
    {
        $app->offsetGet('orchestra.app')->shouldBeCalled(1)->willReturn($foundation);
        $app->make('orchestra.platform.menu')->shouldBeCalled(1)->willReturn($menu);

        $foundation->installed()->shouldBeCalled(1)->willReturn(true);

        $this->authorize()->shouldReturn(true);
    }

    function it_cant_be_display_when_is_not_installed(Container $app, Foundation $foundation, Menu $menu)
    {
        $app->offsetGet('orchestra.app')->shouldBeCalled(1)->willReturn($foundation);
        $app->make('orchestra.platform.menu')->shouldBeCalled(1)->willReturn($menu);

        $foundation->installed()->shouldBeCalled(1)->willReturn(false);

        $this->authorize()->shouldReturn(false);
    }
}
