<?php

namespace Drupal\otp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\otp\Form\ReceiveForm;

class NewController extends ControllerBase
{
    public function add()
    {

        $form_class = '\Drupal\otp\Form\ReceiveForm';
		$build = \Drupal::formBuilder()->getForm($form_class);

        return $build;
    }

    public function register()
    {

        $form = '\Drupal\otp\Form\InfoForm';
		$register_form = \Drupal::formBuilder()->getForm($form);

        return $register_form;
    }
}