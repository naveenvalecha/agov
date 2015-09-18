<?php

/**
 * @file
 * \Drupal\agov\Form\ConfigurableProfileDependenciesForm
 */

namespace Drupal\agov\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigurableProfileDependenciesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'configurable_profile_dependencies';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#title'] = $this->t('aGov Module Configuration');
    $install_state = $form_state->getBuildInfo()['args'][0];

    // If we have any configurable_dependencies in the profile then show them
    // to the user so they can be selected.
    if (!empty($install_state['profile_info']['configurable_dependencies'])) {
      $options = [];
      $defaults = [];
      foreach ($install_state['profile_info']['configurable_dependencies'] as $module_name => $info) {
        $options[$module_name] = $info['label'];
        if (!empty($info['enabled'])) {
          $defaults[] = $module_name;
        }
      }

      $form['configurable_modules'] = [
        '#title' => $this->t('Configurable modules'),
        '#type' => 'checkboxes',
        '#options' => $options,
        '#default_value' => $defaults,
      ];
    }
    else {
      $form['#suffix'] = $this->t('There are no available modules at this time.');
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
    // $this->moduleInstaller->install($form_state->getValues('configurable_modules'));
  }

}
