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
  Button
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
      <div class="cheatsheet-group">
        <?=new Button(null, 'Primary')?>

        <?=new Button(['class'=>'btn-secondary'], 'Secondary')?>

        <?=new Button(['class'=>'btn-success'], 'Success')?>

        <?=new Button(['class'=>'btn-info'], 'Info')?>

        <?=new Button(['class'=>'btn-warning'], 'Warning')?>

        <?=new Button(['class'=>'btn-danger'], 'Danger')?>

        <?=new Button(['class'=>'btn-light'], 'Light')?>

        <?=new Button(['class'=>'btn-dark'], 'Dark')?>

        <?=new Button(['class'=>'btn-link'], 'Link')?>

      </div><!--.cheatsheet-group-->
      <h3>Outline</h3>
      <div class="cheatsheet-group">
        <?=new Button(['class'=>'btn-outline-primary'], 'Primary')?>

        <?=new Button(['class'=>'btn-outline-secondary'], 'Secondary')?>

        <?=new Button(['class'=>'btn-outline-success'], 'Success')?>

        <?=new Button(['class'=>'btn-outline-info'], 'Info')?>

        <?=new Button(['class'=>'btn-outline-warning'], 'Warning')?>

        <?=new Button(['class'=>'btn-outline-danger'], 'Danger')?>

        <?=new Button(['class'=>'btn-outline-light'], 'Light')?>

        <?=new Button(['class'=>'btn-outline-dark'], 'Dark')?>

      </div><!--.cheatsheet-group-->
      <h3>Sizing</h3>
      <div class="cheatsheet-group">
        <?=new Button(['class'=>'btn-sm'], 'Small button')?>

        <?=new Button(null, 'Standard button')?>

        <?=new Button(['class'=>'btn-lg'], 'Large button')?>

      </div><!--.cheatsheet-group-->
      <h3>Disabled</h3>
      <div class="cheatsheet-group">
        <?=new Button(['disabled'=>true], 'Primary')?>

        <?=new Button(['class'=>'btn-secondary', 'disabled'=>true], 'Secondary')?>

        <?=new Button(['class'=>'btn-outline-primary', 'disabled'=>true], 'Primary')?>

        <?=new Button(['class'=>'btn-outline-secondary', 'disabled'=>true], 'Secondary')?>

        <?=new Button(['class'=>'btn-link', 'disabled'=>true], 'Link')?>

      </div><!--.cheatsheet-group-->
    </div><!--.container-->
    <script src="bundles/bootstrap-5.3.3/js/bootstrap.bundle.js"></script>
  </body>
</html>
