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
	NavbarNav,
	NavbarItem,
	NavbarDropdown,
	NavbarDropdownItem,
	NavbarDropdownDivider,
	VerticalPillTabNavigation,
	VerticalPillTabs,
	PillTab,
	TabPanes,
	TabPane,
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
	FormComposites\FormTextArea,
	FormComposites\FormTextAreaFL,
	Spinner,
	Modal
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cheatsheet · Charis</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="frontend/bootstrap-5.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="cheatsheet.css">
</head>
<body>
	<?=new Navbar(null, [
		new Container(null, [
			new NavbarBrand(null, 'Charis Cheatsheet')
		])
	])?>
	<div class="container mb-5">
		<!----------------------------------------------------------------------
		 ! Navbar
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Navbar</h3>
		<div class="cs-group">
			<?=new Navbar(['class' => 'navbar-expand-sm'], [
				new Container(null, [
					new NavbarBrand(null, 'Brand'),
					new NavbarToggler([
						'data-bs-target' => '#navbarCollapse',
						'aria-controls' => 'navbarCollapse'
					]),
					new NavbarCollapse(['id' => 'navbarCollapse'], [
						new NavbarNav(['class' => 'ms-auto'], [
							new NavbarItem([':label' => 'Home', ':active' => true]),
							new NavbarItem([':label' => 'Tools', ':disabled' => true]),
							new NavbarItem([':label' => 'Register']),
							new NavbarItem([':label' => 'Login']),
							new NavbarDropdown([':label' => 'Settings'], [
								new NavbarDropdownItem([':label' => 'Profile']),
								new NavbarDropdownItem([':label' => 'Security']),
								new NavbarDropdownDivider(),
								new NavbarDropdownItem([':label' => 'Help'])
							])
						])
					])
				])
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Vertical PillTab Navigation
		 !---------------------------------------------------------------------->
		<h3 class="cs-heading">Vertical PillTab Navigation</h3>
		<div class="cs-group">
			<?=new VerticalPillTabNavigation([], [
				new VerticalPillTabs([], [
					new PillTab([':key' => 'home', ':active' => true], 'Home'),
					new PillTab([':key' => 'profile'], 'Profile'),
					new PillTab([':key' => 'disabled', 'disabled' => true], 'Disabled'),
					new PillTab([':key' => 'messages'], 'Messages'),
					new PillTab([':key' => 'settings'], 'Settings'),
				]),
				new TabPanes([], [
					new TabPane([':key' => 'home', ':active' => true], 'Welcome to the home section.'),
					new TabPane([':key' => 'profile'], 'Edit your profile information here.'),
					new TabPane([':key' => 'disabled'], 'This section is currently disabled.'),
					new TabPane([':key' => 'messages'], 'Your recent messages will appear here.'),
					new TabPane([':key' => 'settings'], 'Manage your settings and preferences.')
				])
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Collapse
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Collapse</h3>
		<div class="cs-group">
			<?=new Button([
				'data-bs-toggle' => 'collapse',
				'data-bs-target' => '#collapseExample',
				'aria-expanded' => false,
				'aria-controls' => 'collapseExample'
			], 'Toggle collapse')?>
			<?=new Collapse(['id' => 'collapseExample'], 'This is a collapse.')?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Button</h3>
		<h5 class="cs-subheading">Variants</h5>
		<div class="cs-group">
			<?=new Button(null, 'Primary')?>
			<?=new Button(['class' => 'btn-secondary'], 'Secondary')?>
			<?=new Button(['class' => 'btn-success'], 'Success')?>
			<?=new Button(['class' => 'btn-info'], 'Info')?>
			<?=new Button(['class' => 'btn-warning'], 'Warning')?>
			<?=new Button(['class' => 'btn-danger'], 'Danger')?>
			<?=new Button(['class' => 'btn-light'], 'Light')?>
			<?=new Button(['class' => 'btn-dark'], 'Dark')?>
			<?=new Button(['class' => 'btn-link'], 'Link')?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Outline</h5>
		<div class="cs-group">
			<?=new Button(['class' => 'btn-outline-primary'], 'Primary')?>
			<?=new Button(['class' => 'btn-outline-secondary'], 'Secondary')?>
			<?=new Button(['class' => 'btn-outline-success'], 'Success')?>
			<?=new Button(['class' => 'btn-outline-info'], 'Info')?>
			<?=new Button(['class' => 'btn-outline-warning'], 'Warning')?>
			<?=new Button(['class' => 'btn-outline-danger'], 'Danger')?>
			<?=new Button(['class' => 'btn-outline-light'], 'Light')?>
			<?=new Button(['class' => 'btn-outline-dark'], 'Dark')?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Sizing</h5>
		<div class="cs-group">
			<?=new Button(['class' => 'btn-sm'], 'Small button')?>
			<?=new Button(null, 'Standard button')?>
			<?=new Button(['class' => 'btn-lg'], 'Large button')?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Disabled</h5>
		<div class="cs-group">
			<?=new Button(['disabled' => true], 'Primary')?>
			<?=new Button(['class' => 'btn-secondary', 'disabled' => true], 'Secondary')?>
			<?=new Button(['class' => 'btn-outline-primary', 'disabled' => true], 'Primary')?>
			<?=new Button(['class' => 'btn-outline-secondary', 'disabled' => true], 'Secondary')?>
			<?=new Button(['class' => 'btn-link', 'disabled' => true], 'Link')?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button Group
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Button Group</h3>
		<h5 class="cs-subheading">Basic</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(null, 'Left'),
				new Button(null, 'Middle'),
				new Button(null, 'Right')
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Mixed</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(['class' => 'btn-danger'], 'Left'),
				new Button(['class' => 'btn-warning'], 'Middle'),
				new Button(['class' => 'btn-success'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Outlined</h5>
		<div class="cs-group">
			<?=new ButtonGroup([], [
				new Button(['class' => 'btn-outline-primary'], 'Left'),
				new Button(['class' => 'btn-outline-primary'], 'Middle'),
				new Button(['class' => 'btn-outline-primary'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Sizing</h5>
		<div class="cs-group">
			<?=new ButtonGroup(['class' => 'btn-group-sm'], [
				new Button(['class' => 'btn-outline-primary'], 'Left'),
				new Button(['class' => 'btn-outline-primary'], 'Middle'),
				new Button(['class' => 'btn-outline-primary'], 'Right')
			])?>
			<?=new ButtonGroup(['class' => 'btn-group-lg'], [
				new Button(['class' => 'btn-outline-primary'], 'Left'),
				new Button(['class' => 'btn-outline-primary'], 'Middle'),
				new Button(['class' => 'btn-outline-primary'], 'Right')
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Vertical</h5>
		<div class="cs-group">
			<?=new ButtonGroup(['class' => 'btn-group-vertical'], [
				new Button(null, 'Left'),
				new Button(null, 'Middle'),
				new Button(null, 'Right')
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Button Toolbar
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Button Toolbar</h3>
		<div class="cs-group">
			<?=new ButtonToolbar([], [
				new ButtonGroup(['class' => 'me-2'], [
					new Button(null, '1'),
					new Button(null, '2'),
					new Button(null, '3'),
					new Button(null, '4')
				]),
				new ButtonGroup(['class' => 'me-2'], [
					new Button(['class' => 'btn-secondary'], '5'),
					new Button(['class' => 'btn-secondary'], '6'),
					new Button(['class' => 'btn-secondary'], '7')
				]),
				new ButtonGroup([], [
					new Button(['class' => 'btn-info'], '8')
				]),
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Check
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Check</h3>
		<div class="cs-group">
			<div>
				<?=new FormCheck([
					':label' => 'Default checkbox',
					':input:id' => 'check1'
				])?>
				<?=new FormCheck([
					':label' => 'Checked checkbox',
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormCheck([
					':label' => 'Disabled checkbox',
					':input:disabled' => true
				])?>
				<?=new FormCheck([
					':label' => 'Disabled checked checkbox',
					':input:disabled' => true,
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Help Text</h5>
		<div class="cs-group">
			<?=new FormCheck([
				':label' => 'I agree to the terms and conditions',
				':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormCheck([
					'class' => 'form-check-inline',
					':label' => '1'
				])?>
				<?=new FormCheck([
					'class' => 'form-check-inline',
					':label' => '2'
				])?>
				<?=new FormCheck([
					'class' => 'form-check-inline',
					':label' => '3 (disabled)',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormCheck([
					'class' => 'form-check-reverse',
					':label' => 'Reverse checkbox'
				])?>
				<?=new FormCheck([
					'class' => 'form-check-reverse',
					':label' => 'Disabled reverse checkbox',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Radio
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Radio</h3>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':label' => 'Default radio',
					':input:name' => 'RadioGroup1',
					':input:id' => 'radio1'
				])?>
				<?=new FormRadio([
					':label' => 'Checked radio',
					':input:name' => 'RadioGroup1',
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':label' => 'Disabled radio',
					':input:name' => 'RadioGroup2',
					':input:disabled' => true
				])?>
				<?=new FormRadio([
					':label' => 'Disabled checked radio',
					':input:name' => 'RadioGroup2',
					':input:disabled' => true,
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Help Text</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					':label' => 'Credit Card',
					':input:name' => 'payment_method',
					':help' => 'Pay securely using your credit card.',
				])?>
				<?=new FormRadio([
					':label' => 'PayPal',
					':input:name' => 'payment_method',
					':help' => 'Use your PayPal account for a quick and secure payment.',
				])?>
				<?=new FormRadio([
					':label' => 'Bank Transfer',
					':input:name' => 'payment_method',
					':help' => 'Transfer funds directly from your bank account.',
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormRadio([
					'class' => 'form-check-inline',
					':label' => '1',
					':input:name' => 'RadioGroup3'
				])?>
				<?=new FormRadio([
					'class' => 'form-check-inline',
					':label' => '2',
					':input:name' => 'RadioGroup3'
				])?>
				<?=new FormRadio([
					'class' => 'form-check-inline',
					':label' => '3 (disabled)',
					':input:name' => 'RadioGroup3',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormRadio([
					'class' => 'form-check-reverse',
					':label' => 'Reverse radio',
					':input:name' => 'RadioGroup4'
				])?>
				<?=new FormRadio([
					'class' => 'form-check-reverse',
					':label' => 'Disabled reverse radio',
					':input:name' => 'RadioGroup4',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Switch
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Switch</h3>
		<div class="cs-group">
			<div>
				<?=new FormSwitch([
					':label' => 'Default switch',
					':input:id' => 'switch1'
				])?>
				<?=new FormSwitch([
					':label' => 'Checked switch',
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Disabled</h5>
		<div class="cs-group">
			<div>
				<?=new FormSwitch([
					':label' => 'Disabled switch',
					':input:disabled' => true
				])?>
				<?=new FormSwitch([
					':label' => 'Disabled checked switch',
					':input:disabled' => true,
					':input:checked' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Help Text</h5>
		<div class="cs-group">
			<?=new FormSwitch([
				':label' => 'I agree to the terms and conditions',
				':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Inline</h5>
		<div class="cs-group">
			<div>
				<?=new FormSwitch([
					'class' => 'form-check-inline',
					':label' => '1'
				])?>
				<?=new FormSwitch([
					'class' => 'form-check-inline',
					':label' => '2'
				])?>
				<?=new FormSwitch([
					'class' => 'form-check-inline',
					':label' => '3 (disabled)',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Reverse</h5>
		<div class="cs-group w-25">
			<div>
				<?=new FormSwitch([
					'class' => 'form-check-reverse',
					':label' => 'Reverse switch'
				])?>
				<?=new FormSwitch([
					'class' => 'form-check-reverse',
					':label' => 'Disabled reverse switch',
					':input:disabled' => true
				])?>
			</div>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Text
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Text</h3>
		<div class="cs-group">
			<?=new FormText([
				':label' => 'Username',
				':input:placeholder' => 'e.g., JohnDoe',
				':help' => 'Your username must be 3–15 characters long.'
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Floating Label</h5>
		<div class="cs-group">
			<?=new FormTextFL([
				':label' => 'Username',
				':help' => 'Your username must be 3–15 characters long.'
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Email
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Email</h3>
		<div class="cs-group">
			<?=new FormEmail([
				':label' => 'Email address',
				':input:placeholder' => 'e.g., username@example.com',
				':help' => "We'll never share your email with anyone else."
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Floating Label</h5>
		<div class="cs-group">
			<?=new FormEmailFL([
				':label' => 'Email address',
				':help' => "We'll never share your email with anyone else."
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Password
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Password</h3>
		<div class="cs-group">
			<?=new FormPassword([
				':label' => 'Password',
				':help' => 'Your password must be 8-20 characters long.'
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Floating Label</h5>
		<div class="cs-group">
			<?=new FormPasswordFL([
				':label' => 'Password',
				':help' => 'Your password must be 8-20 characters long.'
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Form Text Area
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Form Text Area</h3>
		<div class="cs-group">
			<?=new FormTextArea([
				':label' => 'Comments',
				':input:placeholder' => 'Enter your comments here...',
				':input:rows' => 3,
				':help' => 'Please keep your comments brief and to the point.'
			])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Floating Label</h5>
		<div class="cs-group">
			<?=new FormTextAreaFL([
				':label' => 'Comments',
				':input:style' => 'height: 98px;', // Instead of `rows`
				':help' => 'Please keep your comments brief and to the point.'
			])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Spinner
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Spinner</h3>
		<div class="cs-group">
			<?=new Spinner()?>
			<?=new Spinner([':type' => 'grow'])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Colors</h5>
		<div class="cs-group">
			<?=new Spinner(['class' => 'text-primary'])?>
			<?=new Spinner(['class' => 'text-secondary'])?>
			<?=new Spinner(['class' => 'text-success'])?>
			<?=new Spinner(['class' => 'text-info'])?>
			<?=new Spinner(['class' => 'text-warning'])?>
			<?=new Spinner(['class' => 'text-danger'])?>
			<?=new Spinner(['class' => 'text-light'])?>
			<?=new Spinner(['class' => 'text-dark'])?>
		</div><!--.cs-group-->
		<div class="cs-group">
			<?=new Spinner([':type' => 'grow', 'class' => 'text-primary'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-secondary'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-success'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-info'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-warning'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-danger'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-light'])?>
			<?=new Spinner([':type' => 'grow', 'class' => 'text-dark'])?>
		</div><!--.cs-group-->
		<h5 class="cs-subheading">Size</h5>
		<div class="cs-group">
			<?=new Spinner([':size' => 'sm'])?>
			<?=new Spinner([':type' => 'grow', ':size' => 'sm'])?>
		</div><!--.cs-group-->

		<!----------------------------------------------------------------------
		 ! Modal
		 !--------------------------------------------------------------------->
		<h3 class="cs-heading">Modal</h3>
		<div class="cs-group">
			<?=new Button([
				'data-bs-toggle' => 'modal',
				'data-bs-target' => '#exampleModal'
			], 'Launch modal')?>
			<?=new Modal([
				'id' => 'exampleModal',
				'class' => 'fade',
				':dialog:class' => 'modal-dialog-centered',
				':title' => 'Modal title',
				':body' => 'Modal body text goes here.'
			])?>
		</div><!--.cs-group-->

	</div><!--.container-->
	<script src="frontend/bootstrap-5.3.7/js/bootstrap.bundle.js"></script>
</body>
</html>
