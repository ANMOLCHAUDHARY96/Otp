<?php
/**
 * @file
 * Contains \Drupal\otp\Form\infoForm.
 */
namespace Drupal\otp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class InfoForm extends FormBase {

  public function getFormId() {
    return 'info_form';
  }

 
  public function buildForm(array $form, FormStateInterface $form_state) {
   $res = get_details();
    $form['user_name'] = array(
    '#type' => 'textfield',
    '#title' => t('User Name:'),
    '#required' => TRUE,
    );

    $form['email_id'] = array(
    '#type' => 'email',
    '#title' => t('Email ID:'),
    '#required' => TRUE,
    '#default_value' => (isset($res[0]->email_id)) ? $res[0]->email_id:'',
    );

    $form['mobile'] = array(
    '#type' => 'tel',
    '#title' => t('Mobile No'),
    '#required' => TRUE,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Registration'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

         drupal_set_message(t('Your Registration Completed.')); 
  
  }
}