<?php
/*
*
* WC Thankyou view 
*
*/

if (!defined('ABSPATH')) exit; ?>

	<?php do_action('bc-qr-code_thankyou_before', $order, $payment_getway); ?>
	
		<div class="bc-qr-wrap">
		<?php do_action('bc-qr-code_thankyou_form_before', $order, $payment_getway); ?>
		
			<div class="bc-qr-header">
				<h5><?php echo sprintf(__('Using %s mobile application to scan qr code.', 'qrcode-payment-for-vietnam'), $payment_getway->label); ?></h5>
				
				<div class="bc-qr-infobox">
				<?PHP if (!empty($payment_getway->phone)) { ?>
					<div class="bc-qr-item">
						<label><?php _e('Receiver', 'qrcode-payment-for-vietnam'); ?></label>
						
					<?php echo sprintf(
						'%s - %s', 
						empty($payment_getway->fullname) ? get_bloginfo('name') : $payment_getway->fullname, 
						$payment_getway->phone
					); ?>
					</div>
				<?php } ?>
					
					<div class="bc-qr-item">
						<label><?php _e('Total', 'qrcode-payment-for-vietnam'); ?></label>
						
						<strong class="bc-qr-hightlight">
						<?php echo $order->get_formatted_order_total(); ?>
						</strong>
					</div>
					<div class="bc-qr-item">
						<label><?php _e('Addition payment content', 'qrcode-payment-for-vietnam'); ?></label>
					
						<strong class="bc-qr-hightlight">
						<?php echo sprintf(
							'%s%s', 
							$payment_getway->invoice_prefix, 
							$order->get_id()
						); ?>
						</strong>
					</div>
				</div>
			</div>
	
			<div class="bc-qr-body">
				<a href="javascript:;" class="bc-qr-button green download bc-qr-mobile" download="<?php echo sprintf(
						'%s%s', 
						$payment_getway->invoice_prefix, 
						$order->get_id()
					); ?>">
					<label><?php _e('Download Qr Code', 'qrcode-payment-for-vietnam'); ?></label>
				</a>
			
			<?php echo do_shortcode('[bc_qr_code order_id='.$order->get_id().']'); ?>
			
			<?php do_action('bc-qr-code_thankyou_form_body', $order, $payment_getway); ?>
			</div>
	
			<div class="bc-qr-footer">
				<p class="bc-qr-mobile"><?php echo sprintf(__('You can use %s mobile application to scan qr code.', 'qrcode-payment-for-vietnam'), $payment_getway->label); ?></p>
				
				<a href="<?php echo $payment_getway->app_url; ?>" class="bc-qr-button bc-qr-mobile">
					<label><?php _e('Open app', 'qrcode-payment-for-vietnam'); ?></label>
				</a>
				
				<p style="margin-top: 1px;" class="bc-qr-mobile">
					<img src="<?php echo plugins_url('qrcode-payment-for-vietnam/assets/images/guide-'.$payment_getway->app_slug.'.png'); ?>" style="margin: auto;" />
				</p>
				
				<p><?php _e('Are you already paid?', 'qrcode-payment-for-vietnam'); ?></p>
				
				<a href="javascript:;" class="bc-qr-button green remind" data-title="<?php _e('Thank You!', 'qrcode-payment-for-vietnam'); ?>" data-close="<?php _e('Close', 'qrcode-payment-for-vietnam'); ?>">
					<label><?php _e('Submit to us!', 'qrcode-payment-for-vietnam'); ?></label>
				</a>
				
				
			<?php do_action('bc-qr-code_thankyou_form_footer', $order, $payment_getway); ?>
			</div>
	
		<?php do_action('bc-qr-code_thankyou_form_after', $order, $payment_getway); ?>
		</div>
	

	<?php do_action('bc-qr-code_thankyou_after', $order, $payment_getway); ?>