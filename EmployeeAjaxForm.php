<?php

namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\commandinterface;

/**
 * Provides an AJAX Employee Form.
 */
class EmployeeAjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'employee_ajax_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['employee_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Employee Name'),
      '#required' => TRUE,
    ];

    $form['employee_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Employee Email'),
      '#required' => TRUE,
    ];

    $form['employee_number'] = [ // changed from employee_Number
      '#type' => 'number', // lowercase 'number'
      '#title' => $this->t('Employee Number'),
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#ajax' => [
        'callback' => '::setmessage',
      ],
    ];

    $form['#attached']['library'][] = 'employee/employee';
    return $form;
  }

  /**
   * AJAX callback function.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

  }

  /**
   * Regular form submit (not used in AJAX).
   */
  public function setmessage(array &$form, FormStateInterface $form_state) {
    // You can leave this empty if only using AJAX.
    \Drupal::messenger()->addMessage($this->t('Employee information has been saved successfully.'));
    $response = new AjaxResponse();
    $response->addCommand(new InvokeCommand('html', 'demo', [])); 
    return $response;
  }

}
