<?php
/**
 * @file
 * Contains \Drupal\otp\Form\otpForm.
 */
namespace Drupal\otp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class OtpForm extends FormBase {

  public function getFormId() {
    return 'otp_form';
  }

 
   public function buildForm(array $form, FormStateInterface $form_state) {


    $form['email_id'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $mail = $form_state->getValue('email_id');
    if (empty($mail)) {
    drupal_set_message(t('There was a problem sending your message and it was not sent.'), 'error');
     }
    else {
       drupal_set_message(t('Your message has been sent.'));
    }
    $stmail = $form_state->getValue('email_id');
    $gen = generatePIN();
    $time = REQUEST_TIME;
     $newDate = date("m-d-Y", $time);

    $query = \Drupal::database()->insert('app_otp');
    $query->fields(['store_otp','email_id']);
    $query->values(['store_otp' =>  $gen,'email_id' => $stmail,'changed'=>$newDate,]);
    $result = $query->execute();

    if ($result) {
      $this->sendMail($stmail);
      drupal_set_message('OTP Sent To Your Mail');
    }
    $redirect = $form_state->setRedirect('otp.receiveform');  //redirect on otp page after submit
  }

  public function sendMail($email) {
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $mailManager = \Drupal::service('plugin.manager.mail');
    $params['message'] = 'This is body of Otp form';
    $mailManager->mail('stats', 'cusmail', $email, $langcode, $params, NULL, true);
  }
     
}
