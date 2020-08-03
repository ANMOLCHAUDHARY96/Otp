<?php
/**
 * @file
 * Contains \Drupal\otp\Form\receiveForm.
 */
namespace Drupal\otp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ReceiveForm extends FormBase {

  public function getFormId() {
    return 'receive_form';
  }

 
   public function buildForm(array $form, FormStateInterface $form_state) {

    $form['otp_element'] = array(
    '#type' => 'number',
    '#attributes' => array(
        ' type' => 'number', // insert space before attribute name :)
    ),
    '#title' => 'Enter Otp',
    '#required' => true,
    '#maxlength' => 4
);

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit Otp'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

     $query = \Drupal::database()->insert('app_otp');
      $query->fields(['otp_element',]);
      $query->values(array(
      $form_state->getValue('otp_element'),       

    ));

    function get_otp(){  
      if(\Drupal::database()->schema()->tableExists('app_otp')){
        $data = [];
        $query = \Drupal::database()->select('app_otp', 'ot');
        $query->fields('ot', ['store_otp']);
        $rows = $query->execute();
        $result = $rows->fetchAll();
        return $result;
        
      }

    }  
    if ($query->execute()) {
        $os = get_otp();
      if($os === $os){
            drupal_set_message('Your Otp submitted!');
            $redirect = $form_state->setRedirect('otp.infoform');
        }
        else{
            drupal_set_message(t('Invalid otp or digits are less than 4'));
        }
    }

  }
}