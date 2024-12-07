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

require 'bootstrap.php';

use \Charis\{
  Button,
  ButtonGroup,
  ButtonToolbar
};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cheatsheet · Charis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bundles/bootstrap-5.3.3/css/bootstrap.css">
    <link rel="stylesheet" href="cheatsheet.css">
  </head>
  <body>
    <nav class="navbar navbar-expand bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand" href="#">Charis Cheatsheet</a>
      </div>
    </nav>
    <div class="container">

      <h2>Button</h2>
      <h3>Variants</h3>
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
      <h3>Outline</h3>
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
      <h3>Sizing</h3>
      <div class="cs-group">
        <?=new Button(['class'=>'btn-sm'], 'Small button')?>

        <?=new Button(null, 'Standard button')?>

        <?=new Button(['class'=>'btn-lg'], 'Large button')?>

      </div><!--.cs-group-->
      <h3>Disabled</h3>
      <div class="cs-group">
        <?=new Button(['disabled'=>true], 'Primary')?>

        <?=new Button(['class'=>'btn-secondary', 'disabled'=>true], 'Secondary')?>

        <?=new Button(['class'=>'btn-outline-primary', 'disabled'=>true], 'Primary')?>

        <?=new Button(['class'=>'btn-outline-secondary', 'disabled'=>true], 'Secondary')?>

        <?=new Button(['class'=>'btn-link', 'disabled'=>true], 'Link')?>

      </div><!--.cs-group-->

      <h2>Button Group</h2>
      <h3>Basic</h3>
      <div class="cs-group">
        <?=new ButtonGroup(['aria-label'=>'Basic button group'], [
          new Button(null, 'Left'),
          new Button(null, 'Middle'),
          new Button(null, 'Right')
        ])?>

      </div><!--.cs-group-->
      <h3>Mixed</h3>
      <div class="cs-group">
        <?=new ButtonGroup(['aria-label'=>'Mixed button group'], [
          new Button(['class'=>'btn-danger'], 'Left'),
          new Button(['class'=>'btn-warning'], 'Middle'),
          new Button(['class'=>'btn-success'], 'Right')
        ])?>

      </div><!--.cs-group-->
      <h3>Outlined</h3>
      <div class="cs-group">
        <?=new ButtonGroup(['aria-label'=>'Outlined button group'], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ])?>

      </div><!--.cs-group-->
      <h3>Sizing</h3>
      <div class="cs-group">
        <?=new ButtonGroup(['class'=>'btn-group-sm', 'aria-label'=>'Small button group'], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ])?>

        <?=new ButtonGroup(['class'=>'btn-group-lg', 'aria-label'=>'Large button group'], [
          new Button(['class'=>'btn-outline-primary'], 'Left'),
          new Button(['class'=>'btn-outline-primary'], 'Middle'),
          new Button(['class'=>'btn-outline-primary'], 'Right')
        ])?>

      </div><!--.cs-group-->
      <h3>Vertical</h3>
      <div class="cs-group">
        <?=new ButtonGroup(['class'=>'btn-group-vertical', 'aria-label'=>'Vertical button group'], [
          new Button(null, 'Left'),
          new Button(null, 'Middle'),
          new Button(null, 'Right')
        ])?>

      </div><!--.cs-group-->

      <h2>Button Toolbar</h2>
      <div class="cs-group">
        <?=new ButtonToolbar(['aria-label'=>'Button toolbar'], [
          new ButtonGroup(['class'=>'me-2', 'aria-label'=>'First group'], [
            new Button(null, '1'),
            new Button(null, '2'),
            new Button(null, '3'),
            new Button(null, '4')
          ]),
          new ButtonGroup(['class'=>'me-2', 'aria-label'=>'Second group'], [
            new Button(['class'=>'btn-secondary'], '5'),
            new Button(['class'=>'btn-secondary'], '6'),
            new Button(['class'=>'btn-secondary'], '7')
          ]),
          new ButtonGroup(['aria-label'=>'Third group'], [
            new Button(['class'=>'btn-info'], '8')
          ]),
        ])?>

      </div><!--.cs-group-->

    </div><!--.container-->
    <script src="bundles/bootstrap-5.3.3/js/bootstrap.bundle.js"></script>
  </body>
</html>
