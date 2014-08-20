<?php
namespace Acme\ProjectB;

use Interop\Container\ContainerInterface;
use Interop\Container\Pimple\PimpleInterop;

class Factory {
	
	public static function getContainer(ContainerInterface $rootContainer) {
		// Let's create a simple container that provides 2 entries: 'a' and 'c'.
		// 'a' has an external dependency on a 'b' object that is not part of this project.
		$pimple = new PimpleInterop($rootContainer);
		$pimple['b'] = $pimple->share(function(ContainerInterface $container) {
			$b = new \stdClass();
			$b->c = $container->get('c');
			return $b;
		});
		return $pimple;
	}
}