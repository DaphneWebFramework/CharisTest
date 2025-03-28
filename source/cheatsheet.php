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
  Button,
  ButtonGroup,
  ButtonToolbar,
  FormComposites\FormCheck,
  FormComposites\FormRadio,
  FormComposites\FormSwitch,
  FormComposites\FormText,
  FormComposites\FormFLText,
  Navbar,
  NavbarBrand,
  Container,
};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cheatsheet · Charis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="frontend/bootstrap-5.3.3/css/bootstrap.css">
    <link rel="stylesheet" href="cheatsheet.css">
  </head>
  <body>
    <?=new Navbar(null, [
      new Container(null, [
          new NavbarBrand(null, 'Charis Cheatsheet')
      ])
    ]).PHP_EOL?>
    <div class="container">
      <!------------------------------------------------------------------------
       ! Button
       !----------------------------------------------------------------------->
      <h3>Button</h3>
      <h4>Variants</h4>
      <div class="cs-group">
        <?=new Button(null, 'Primary').PHP_EOL?>
        <?=new Button(['class'=>'btn-secondary'], 'Secondary').PHP_EOL?>
        <?=new Button(['class'=>'btn-success'], 'Success').PHP_EOL?>
        <?=new Button(['class'=>'btn-info'], 'Info').PHP_EOL?>
        <?=new Button(['class'=>'btn-warning'], 'Warning').PHP_EOL?>
        <?=new Button(['class'=>'btn-danger'], 'Danger').PHP_EOL?>
        <?=new Button(['class'=>'btn-light'], 'Light').PHP_EOL?>
        <?=new Button(['class'=>'btn-dark'], 'Dark').PHP_EOL?>
        <?=new Button(['class'=>'btn-link'], 'Link').PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Outline</h4>
      <div class="cs-group">
        <?=new Button(['class'=>'btn-outline-primary'], 'Primary').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-secondary'], 'Secondary').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-success'], 'Success').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-info'], 'Info').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-warning'], 'Warning').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-danger'], 'Danger').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-light'], 'Light').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-dark'], 'Dark').PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Sizing</h4>
      <div class="cs-group">
        <?=new Button(['class'=>'btn-sm'], 'Small button').PHP_EOL?>
        <?=new Button(null, 'Standard button').PHP_EOL?>
        <?=new Button(['class'=>'btn-lg'], 'Large button').PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Disabled</h4>
      <div class="cs-group">
        <?=new Button(['disabled'=>true], 'Primary').PHP_EOL?>
        <?=new Button(['class'=>'btn-secondary', 'disabled'=>true], 'Secondary').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-primary', 'disabled'=>true], 'Primary').PHP_EOL?>
        <?=new Button(['class'=>'btn-outline-secondary', 'disabled'=>true], 'Secondary').PHP_EOL?>
        <?=new Button(['class'=>'btn-link', 'disabled'=>true], 'Link').PHP_EOL?>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Button Group
       !----------------------------------------------------------------------->
      <h3>Button Group</h3>
      <h4>Basic</h4>
      <div class="cs-group">
        <?=new ButtonGroup([], [
          new Button(null, 'Left'),
          new Button(null, 'Middle'),
          new Button(null, 'Right')
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Mixed</h4>
      <div class="cs-group">
        <?=new ButtonGroup([], [
          new Button(['class'=>'btn-danger'], 'Left'),
          new Button(['class'=>'btn-warning'], 'Middle'),
          new Button(['class'=>'btn-success'], 'Right')
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Outlined</h4>
      <div class="cs-group">
        <?=new ButtonGroup([], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Sizing</h4>
      <div class="cs-group">
        <?=new ButtonGroup(['class'=>'btn-group-sm'], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ]).PHP_EOL?>
        <?=new ButtonGroup(['class'=>'btn-group-lg'], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Vertical</h4>
      <div class="cs-group">
        <?=new ButtonGroup(['class'=>'btn-group-vertical'], [
          new Button(null, 'Left'),
          new Button(null, 'Middle'),
          new Button(null, 'Right')
        ]).PHP_EOL?>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Button Toolbar
       !----------------------------------------------------------------------->
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
        ]).PHP_EOL?>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Form Check
       !----------------------------------------------------------------------->
      <h3>Form Check</h3>
      <div class="cs-group">
        <div>
          <?=new FormCheck([':id'=>'check1', ':label'=>'Default checkbox']).PHP_EOL?>
          <?=new FormCheck([':label'=>'Checked checkbox', ':checked'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Disabled</h4>
      <div class="cs-group">
        <div>
          <?=new FormCheck([':label'=>'Disabled checkbox', ':disabled'=>true]).PHP_EOL?>
          <?=new FormCheck([':label'=>'Disabled checked checkbox', ':disabled'=>true, ':checked'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Help Text</h4>
      <div class="cs-group">
        <?=new FormCheck([
          ':label' => 'I agree to the terms and conditions',
          ':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Inline</h4>
      <div class="cs-group">
        <div>
          <?=new FormCheck(['class'=>'form-check-inline', ':label'=>'1']).PHP_EOL?>
          <?=new FormCheck(['class'=>'form-check-inline', ':label'=>'2']).PHP_EOL?>
          <?=new FormCheck(['class'=>'form-check-inline', ':label'=>'3 (disabled)', ':disabled'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Reverse</h4>
      <div class="cs-group w-25">
        <div>
          <?=new FormCheck([
            'class'=>'form-check-reverse',
            ':label'=>'Reverse checkbox'
          ]).PHP_EOL?>
          <?=new FormCheck([
            'class'=>'form-check-reverse',
            ':label'=>'Disabled reverse checkbox',
            ':disabled'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Form Radio
       !----------------------------------------------------------------------->
      <h3>Form Radio</h3>
      <div class="cs-group">
        <div>
          <?=new FormRadio([
            ':name'=>'RadioGroup1',
            ':id'=>'radio1',
            ':label'=>'Default radio'
          ]).PHP_EOL?>
          <?=new FormRadio([
            ':name'=>'RadioGroup1',
            ':label'=>'Checked radio',
            ':checked'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Disabled</h4>
      <div class="cs-group">
        <div>
          <?=new FormRadio([
            ':name'=>'RadioGroup2',
            ':label'=>'Disabled radio',
            ':disabled'=>true
          ]).PHP_EOL?>
          <?=new FormRadio([
            ':name'=>'RadioGroup2',
            ':label'=>'Disabled checked radio',
            ':disabled'=>true,
            ':checked'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Help Text</h4>
      <div class="cs-group">
        <div>
          <?=new FormRadio([
            ':label' => 'Credit Card',
            ':name' => 'payment_method',
            ':help' => 'Pay securely using your credit card.',
          ]).PHP_EOL?>
          <?=new FormRadio([
            ':label' => 'PayPal',
            ':name' => 'payment_method',
            ':help' => 'Use your PayPal account for a quick and secure payment.',
          ]).PHP_EOL?>
          <?=new FormRadio([
            ':label' => 'Bank Transfer',
            ':name' => 'payment_method',
            ':help' => 'Transfer funds directly from your bank account.',
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Inline</h4>
      <div class="cs-group">
        <div>
          <?=new FormRadio([
            'class'=>'form-check-inline',
            ':name'=>'RadioGroup3',
            ':label'=>'1'
          ]).PHP_EOL?>
          <?=new FormRadio([
            'class'=>'form-check-inline',
            ':name'=>'RadioGroup3',
            ':label'=>'2'
          ]).PHP_EOL?>
          <?=new FormRadio([
            'class'=>'form-check-inline',
            ':name'=>'RadioGroup3',
            ':label'=>'3 (disabled)',
            ':disabled'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Reverse</h4>
      <div class="cs-group w-25">
        <div>
          <?=new FormRadio([
            'class'=>'form-check-reverse',
            ':name'=>'RadioGroup4',
            ':label'=>'Reverse radio'
          ]).PHP_EOL?>
          <?=new FormRadio([
            'class'=>'form-check-reverse',
            ':name'=>'RadioGroup4',
            ':label'=>'Disabled reverse radio',
            ':disabled'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Form Switch
       !----------------------------------------------------------------------->
      <h3>Form Switch</h3>
      <div class="cs-group">
        <div>
          <?=new FormSwitch([':id'=>'switch1', ':label'=>'Default switch']).PHP_EOL?>
          <?=new FormSwitch([':label'=>'Checked switch', ':checked'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Disabled</h4>
      <div class="cs-group">
        <div>
          <?=new FormSwitch([':label'=>'Disabled switch', ':disabled'=>true]).PHP_EOL?>
          <?=new FormSwitch([':label'=>'Disabled checked switch', ':disabled'=>true, ':checked'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Help Text</h4>
      <div class="cs-group">
        <?=new FormSwitch([
          ':label' => 'I agree to the terms and conditions',
          ':help' => 'By selecting this, you agree to our terms of service and privacy policy.'
        ]).PHP_EOL?>
      </div><!--.cs-group-->
      <h4>Inline</h4>
      <div class="cs-group">
        <div>
          <?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'1']).PHP_EOL?>
          <?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'2']).PHP_EOL?>
          <?=new FormSwitch(['class'=>'form-check-inline', ':label'=>'3 (disabled)', ':disabled'=>true]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->
      <h4>Reverse</h4>
      <div class="cs-group w-25">
        <div>
          <?=new FormSwitch([
            'class'=>'form-check-reverse',
            ':label'=>'Reverse switch'
          ]).PHP_EOL?>
          <?=new FormSwitch([
            'class'=>'form-check-reverse',
            ':label'=>'Disabled reverse switch',
            ':disabled'=>true
          ]).PHP_EOL?>
        </div>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Form Text
       !----------------------------------------------------------------------->
      <h3>Form Text</h3>
      <div class="cs-group">
        <?=new FormText([
          ':label'=>'Username',
          ':help' => 'Your username must be 3–15 characters long.',
          ':placeholder' => 'e.g., JohnDoe'
        ]).PHP_EOL?>
      </div><!--.cs-group-->

      <!------------------------------------------------------------------------
       ! Form Text (Floating Label)
       !----------------------------------------------------------------------->
      <h3>Form Text (Floating Label)</h3>
      <div class="cs-group">
        <?=new FormFLText([
          ':label'=>'Username',
          ':help' => 'Your username must be 3–15 characters long.'
        ]).PHP_EOL?>
      </div><!--.cs-group-->

    </div><!--.container-->
    <script src="frontend/bootstrap-5.3.3/js/bootstrap.bundle.js"></script>
  </body>
</html>
