<?php

namespace Drupal\Tests\controller_injection_example\Unit;

use Drupal\controller_injection_example\HelloWorldController;
use Drupal\Tests\UnitTestCase;

/**
 * @group controller_injection_example
 * @coversDefaultClass Drupal\controller_injection_example\HelloWorldController
 */
class HelloWorldControllerTest extends UnitTestCase {

  /**
   * @covers ::render
   */
  public function testRender() {
    $configFactory = $this->getConfigFactoryStub([
      'system.site' => [
        'name' => 'Site name',
      ]
    ]);

    $controller = new HelloWorldController($configFactory->get('system.site'), $this->getStringTranslationStub());

    $response = $controller->render();
    $this->assertEquals('markup', $response['#type']);
    $this->assertEquals('Hello from Site name', (string) $response['#markup']);
  }
}
