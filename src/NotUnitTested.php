<?php

namespace Drupal\controller_injection_example;

class NotUnitTested {

  public function render() {
    // The only thing a caller needs to do is to know to call create().
    $controller = HelloWorldController::create(\Drupal::getContainer());
    $response = $controller->render();

    $response['#markup'] = 'This is totally not unit tested.';

    return $response;
  }
}
