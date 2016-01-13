<?php

namespace Drupal\controller_injection_example;

use Drupal\Core\Config\Config;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @class HelloWorldController
 */
class HelloWorldController implements ContainerInjectionInterface {

  /**
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * @var \Drupal\Core\StringTranslation\TranslationInterface
   */
  protected $translation;

  /**
   * {@inheritdoc}
   *
   * @codeCoverageIgnore
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')->get('system.site'),
      $container->get('string_translation')
    );
  }

  /**
   * HelloWorldController constructor.
   *
   * @param \Drupal\Core\Config\Config $config
   * @param \Drupal\Core\StringTranslation\TranslationInterface $translation
   *
   * @codeCoverageIgnore
   * This should be tested by adding getter methods for config and translation.
   */
  public function __construct(Config $config, TranslationInterface $translation) {
    $this->config = $config;
    $this->translation = $translation;
  }

  /**
   * @return array
   */
  public function render() {
    return [
      '#type' => 'markup',
      '#markup' => $this->translation->translate('Hello from @site-name', ['@site-name' => $this->config->get('name')]),
    ];
  }
}
