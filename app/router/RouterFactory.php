<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

        $router[] = $routerBack = new RouteList("Back");
        $routerBack[] = new Route('admin/<presenter>/<action>[/<id>]', 'Login:default');

        $router[] = $routerFront = new RouteList("Front");
        $routerFront[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

		return $router;
	}
}
