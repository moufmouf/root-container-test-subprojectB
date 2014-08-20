<?php
namespace Acme\ProjectA;

use Interop\Container\ContainerInterface;
use Interop\Container\Pimple\PimpleInterop;

class Factory {
	
	public static function getContainer(ContainerInterface $rootContainer) {
		// Let's create a simple container that provides 2 entries: 'a' and 'c'.
		// 'a' has an external dependency on a 'b' object that is not part of this project.
		$pimple = new PimpleInterop($rootContainer);
		$pimple['a']->share(function(ContainerInterface $container) {
			$a = new \stdClass();
			$a->b = $container->get('b');
			return $a;
		});
		$pimple['c']->share(function(ContainerInterface $container) {
			$c = new \stdClass();
			$c->hello = 'world';
			return $c;
		});
	}
}