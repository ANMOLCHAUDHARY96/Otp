<?php
/**
 * @file
 * Contains \Drupal\otp\Plugin\Block\XaiBlock.
 */

namespace Drupal\otp\Plugin\Block;
use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'otp' block.
 *
 * @Block(
 *   id = "otp_block",
 *   admin_label = @Translation("otp block"),
 *   category = @Translation("Custom otp block example")
 * )
 */

class OtpBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $block = \Drupal::formBuilder()->getForm('Drupal\otp\Form\OtpForm');
    return $block;

  }
}