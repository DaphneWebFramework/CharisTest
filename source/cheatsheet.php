<?php declare(strict_types=1);
/**
 * cheatsheet.php
 *
 * (C) 2024 by Eylem Ugurel
 *
 * Licensed under a Creative Commons Attribution 4.0 International License.
 *
 * You should have received a copy of the license along with this work. If not,
 * see <http://creativecommons.org/licenses/by/4.0/>.
 */

require 'autoload.php';

use \Charis\{
	Container,
	Navbar,
	NavbarBrand,
	NavbarToggler,
	NavbarCollapse,
	Collapse,
	Button,
	ButtonGroup,
	ButtonToolbar,
	FormComposites\FormCheck,
	FormComposites\FormRadio,
	FormComposites\FormSwitch,
	FormComposites\FormText,
	FormComposites\FormTextFL,
	FormComposites\FormEmail,
	FormComposites\FormEmailFL,
	FormComposites\FormPassword,
	FormComposites\FormPasswordFL,
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cheatsheet · Charis</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="frontend/bootstrap-5.3.5/css/bootstrap.css">
	<link rel="stylesheet" href="cheatsheet.css">
</head>
<body>
	<?=new Navbar(null, [
		new Container(null, [
			new NavbarBrand(null, 'Charis Cheatsheet')
		])
	])?>
	<div class="container">
		<!----------------------------------------------------------------------
		 ! Navbar
		 !--------------------------------------------------------------------->
		<h3>Navbar</h3>
		<div class="cs-group">
			<?=new Navbar(['class' => 'navbar-expand'], [
				new Container(null, [
					new NavbarBrand(null, 'Brand'),
					new NavbarToggler([
						'data-bs-target'=>'#navbarCollapse',
						'aria-controls'=>'navbarCollapse'
					]),
					new NavbarCollapse(['id'=>'navbarCollapse'], [
						// ...
					])
				])
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Collapse
		 !--------------------------------------------------------------------->
		<h3>Collapse</h3>
		<div class="cs-group">
			<?=new Button([
				'data-bs-toggle'=>'collapse',
				'data-bs-target'=>'#collapseExample',
				'aria-expanded'=>false,
				'aria-controls'=>'collapseExample'
			], 'Toggle collapse')?>
			<?=new Collapse(['id'=>'collapseExample'], 'This is a collapse.')?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button
		 !--------------------------------------------------------------------->
		<h3>Button</h3>
		<h5>Variants</h5>
		<div class="cs-group">
			<?=new Button(null, 'Primary')?>
			<?=new Button(['class'=>'btn-secondary'], 'Secondary')?>
			<?=new Button(['class'=>'btn-success'], 'Success')?>
			<?=new Button(['class'=>'btn-info'], 'Info')?>
			<?=new Button(['class'=>'btn-warning'], 'Warning')?>
			<?=new Button(['class'=>'btn-danger'], 'Danger')?>
			<?=new Button(['class'=>'btn-light'], 'Light')?>
			<?=new Button(['class'=>'btn-dark'], 'Dark')?>
			<?=new Button(['class'=>'btn-link'], 'Link')?>
		</div><!--.cs-group-->
		<h5>Outline</h5>
		<div class="cs-group">
			<?=new Button(['class'=>'btn-outline-primary'], 'Primary')?>
			<?=new Button(['class'=>'btn-outline-secondary'], 'Secondary')?>
			<?=new Button(['class'=>'btn-outline-success'], 'Success')?>
			<?=new Button(['class'=>'btn-outline-info'], 'Info')?>
			<?=new Button(['class'=>'btn-outline-warning'], 'Warning')?>
			<?=new Button(['class'=>'btn-outline-danger'], 'Danger')?>
			<?=new Button(['class'=>'btn-outline-light'], 'Light')?>
			<?=new Button(['class'=>'btn-outline-dark'], 'Dark')?>
		</div><!--.cs-group-->
		<h5>Sizing</h5>
		<div class="cs-group">
			<?=new Button(['class'=>'btn-sm'], 'Small button')?>
			<?=new Button(null, 'Standard button')?>
			<?=new Button(['class'=>'btn-lg'], 'Large button')?>
		</div><!--.cs-group-->
		<h5>Disabled</h5>
		<div class="cs-group">
			<?=new Button(['disabled'=>true], 'Primary')?>
			<?=new Button(['class'=>'btn-secondary', 'disabled'=>true], 'Secondary')?>
			<?=new Button(['class'=>'btn-outline-primary', 'disabled'=>true], 'Primary')?>
			<?=new Button(['class'=>'btn-outline-secondary', 'disabled'=>true], 'Secondary')?>
			<?=new Button(['class'=>'btn-link', 'disabled'=>true], 'Link')?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button Group
		 !--------------------------------------------------------------------->
		<h3>Button Group</h3>
		<h5>Basic</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(null, 'Left'),
				new Button(null, 'Middle'),
				new Button(null, 'Right')
			])?>
		</div><!--.cs-group-->
		<h5>Mixed</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(['class'=>'btn-danger'], 'Left'),
				new Button(['class'=>'btn-warning'], 'Middle'),
				new Button(['class'=>'btn-success'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5>Outlined</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(['class'=>'btn-outline-primary'], 'Left'),
				new Button(['class'=>'btn-outline-primary'], 'Middle'),
				new Button(['class'=>'btn-outline-primary'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5>Sizing</h5>
		<div class="cs-group">
			<?=new ButtonGroup(['class'=>'btn-group-sm'], [
				new Button(['class'=>'btn-outline-primary'], 'Left'),
				new Button(['class'=>'btn-outline-primary'], 'Middle'),
				new Button(['class'=>'btn-outline-primary'], 'Right')
			])?>
			<?=new ButtonGroup(['class'=>'btn-group-lg'], [
				new Button(['class'=>'btn-outline-primary'], 'Left'),
				new Button(['class'=>'btn-outline-primary'], 'Middle'),
				new Button(['class'=>'btn-outline-primary'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5>Vertical</h5>
		<div class="cs-group">
			<?=new ButtonGroup(['class'=>'btn-group-vertical'], [
				new Button(null, 'Left'),
				new Button(null, 'Middle'),
				new Button(null, 'Right')
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button Toolbar
		 !--------------------------------------------------------------------->
		<h3>Button Toolbar</h3>
		<div class="cs-group">
			<?=new ButtonToolbar([], [
				new ButtonGroup(['class'=>'me-2'], [
					new Button(null, '1'),
					new Button(null, '2'),
					new Button(null, '3'),
					new Button(null, '4')
				]),
				new ButtonGroup(['class'=>'me-2'], [
					new Button(['class'=>'btn-secondary'], '5'),
					new Button(['class'=>'btn-secondary'], '6'),
					new Button(['class'=>'btn-secondary'], '7')
				]),
				new ButtonGroup([], [
					new Button(['class'=>'btn-info'], '8')
				]),
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Check
		 !--------------------------------------------------------------------->
		<h3>Form Check</h3>
		<div class="cs-group">
			<div>
				<?=new FormCheck([':id'=>'check1', ':label'=>'Default checkbox'])?>
				<?=new FormCheck([':label'=>'Checked checkbox', ':checked'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormCheck([':label'=>'Disabled checkbox', ':disabled'=>true])?>
				<?=new FormCheck([':label'=>'Disabled checked checkbox', ':disabled'=>true, ':checked'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Help Text</h5>
		<div class="cs-group">
			<?=new FormCheck([
				':label' => 'I agree to the terms and conditions',
				':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
			])?>
		</div><!--.cs-group-->
		<h5>Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormCheck(['class'=>'form-check-inline', ':label'=>'1'])?>
				<?=new FormCheck(['class'=>'form-check-inline', ':label'=>'2'])?>
				<?=new FormCheck(['class'=>'form-check-inline', ':label'=>'3 (disabled)', ':disabled'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormCheck([
					'class'=>'form-check-reverse',
					':label'=>'Reverse checkbox'
				])?>
				<?=new FormCheck([
					'class'=>'form-check-reverse',
					':label'=>'Disabled reverse checkbox',
					':disabled'=>true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Radio
		 !--------------------------------------------------------------------->
		<h3>Form Radio</h3>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':name'=>'RadioGroup1',
					':id'=>'radio1',
					':label'=>'Default radio'
				])?>
				<?=new FormRadio([
					':name'=>'RadioGroup1',
					':label'=>'Checked radio',
					':checked'=>true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5>Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':name'=>'RadioGroup2',
					':label'=>'Disabled radio',
					':disabled'=>true
				])?>
				<?=new FormRadio([
					':name'=>'RadioGroup2',
					':label'=>'Disabled checked radio',
					':disabled'=>true,
					':checked'=>true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5>Help Text</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':label' => 'Credit Card',
					':name' => 'payment_method',
					':help' => 'Pay securely using your credit card.',
				])?>
				<?=new FormRadio([
					':label' => 'PayPal',
					':name' => 'payment_method',
					':help' => 'Use your PayPal account for a quick and secure payment.',
				])?>
				<?=new FormRadio([
					':label' => 'Bank Transfer',
					':name' => 'payment_method',
					':help' => 'Transfer funds directly from your bank account.',
				])?>
			</div>
		</div><!--.cs-group-->
		<h5>Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					'class'=>'form-check-inline',
					':name'=>'RadioGroup3',
					':label'=>'1'
				])?>
				<?=new FormRadio([
					'class'=>'form-check-inline',
					':name'=>'RadioGroup3',
					':label'=>'2'
				])?>
				<?=new FormRadio([
					'class'=>'form-check-inline',
					':name'=>'RadioGroup3',
					':label'=>'3 (disabled)',
					':disabled'=>true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5>Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormRadio([
					'class'=>'form-check-reverse',
					':name'=>'RadioGroup4',
					':label'=>'Reverse radio'
				])?>
				<?=new FormRadio([
					'class'=>'form-check-reverse',
					':name'=>'RadioGroup4',
					':label'=>'Disabled reverse radio',
					':disabled'=>true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Switch
		 !--------------------------------------------------------------------->
		<h3>Form Switch</h3>
		<div class="cs-group">
			<div>
				<?=new FormSwitch([':id'=>'switch1', ':label'=>'Default switch'])?>
				<?=new FormSwitch([':label'=>'Checked switch', ':checked'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormSwitch([':label'=>'Disabled switch', ':disabled'=>true])?>
				<?=new FormSwitch([':label'=>'Disabled checked switch', ':disabled'=>true, ':checked'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Help Text</h5>
		<div class="cs-group">
			<?=new FormSwitch([
				':label' => 'I agree to the terms and conditions',
				':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
			])?>
		</div><!--.cs-group-->
		<h5>Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'1'])?>
				<?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'2'])?>
				<?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'3 (disabled)', ':disabled'=>true])?>
			</div>
		</div><!--.cs-group-->
		<h5>Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormSwitch([
					'class'=>'form-check-reverse',
					':label'=>'Reverse switch'
				])?>
				<?=new FormSwitch([
					'class'=>'form-check-reverse',
					':label'=>'Disabled reverse switch',
					':disabled'=>true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Text
		 !--------------------------------------------------------------------->
		<h3>Form Text</h3>
		<div class="cs-group">
			<?=new FormText([
				':label'=>'Username',
				':help' => 'Your username must be 3–15 characters long.',
				':placeholder' => 'e.g., JohnDoe'
			])?>
		</div><!--.cs-group-->
		<h5>Floating Label</h5>
		<div class="cs-group">
			<?=new FormTextFL([
				':label'=>'Username',
				':help' => 'Your username must be 3–15 characters long.'
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Email
		 !--------------------------------------------------------------------->
		<h3>Form Email</h3>
		<div class="cs-group">
			<?=new FormEmail([
				':label'=>'Email address',
				':help' => "We'll never share your email with anyone else.",
				':placeholder' => 'e.g., username@example.com'
			])?>
		</div><!--.cs-group-->
		<h5>Floating Label</h5>
		<div class="cs-group">
			<?=new FormEmailFL([
				':label'=>'Email address',
				':help' => "We'll never share your email with anyone else."
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Password
		 !--------------------------------------------------------------------->
		<h3>Form Password</h3>
		<div class="cs-group">
			<?=new FormPassword([
				':label'=>'Password',
				':help' => 'Your password must be 8-20 characters long.'
			])?>
		</div><!--.cs-group-->
		<h5>Floating Label</h5>
		<div class="cs-group">
			<?=new FormPasswordFL([
				':label'=>'Password',
				':help' => 'Your password must be 8-20 characters long.'
			])?>
		</div><!--.cs-group-->

	</div><!--.container-->
	<script src="frontend/bootstrap-5.3.5/js/bootstrap.bundle.js"></script>
</body>
</html>
