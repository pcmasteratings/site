<?php

require("res/include.php");

?>
<!DOCTYPE html>
<!-- saved from url=(0026)http://alessandro.pw/pcmr/ -->
<html>
	<head>
		
		
		<?php include("res/head.php"); ?>
		
		<meta charset="UTF-8" />
		<meta name="description" content="this site may come in handy to compute PCMRatings">
		<meta name="author" content="/u/eur0pa">
		<meta name="generator" content="skeleton css">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="./PCMR Rating System calculator_files/css" rel="stylesheet" type="text/css">
  <link href="./localhost/css" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="http://localhost/css/normalize.css">
  <link rel="stylesheet" href="http://localhost/css/skeleton.css">
  <link rel="stylesheet" href="http://localhost/css/main.css">
	</head>
	<body>
	
		<?php include("res/nav.php"); ?>
		<div class="container">
			
			<h4>Select all that apply</h4>
			
			<div id='box'>
			<div class="col-md-4">
				<table class="table">
					<tr><td colspan="2" style="text-align:center; border-top: none;"> <img src="./img/NaN.jpg" alt="" height="150" class="u-max-full-width rating"></td></tr>    
					<th>Item</th><th>Score</th>
					<tr><td>Frame rate</td><td>-</td></tr>
					<tr><td>Resolution</td><td>-</td></tr>
					<tr><td>Optimization</td><td>-</td></tr>
					<tr><td>Mod support</td><td>-</td></tr>
					<tr><td>Servers</td><td>-</td></tr>
					<tr><td>DLC</td><td>-</td></tr>
					<tr><td>Glitches</td><td>-</td></tr>
					<tr><td>Settings</td><td>-</td></tr>
					<tr><td>Controls</td><td>-</td></tr>
					<tr><td>DRM</td><td>-</td></tr>
					<tr><td>Current rating: <span class="rating">?</span></td><td>Current score: <span class="score">0</span></td></tr>
					
				</table>
			</div>
			</div>
			
			<div class="col-md-8">
				<img src="http://static.giantbomb.com/uploads/scale_medium/0/3699/2698809-the+witcher+3+-+wild+hunt+v7.jpg" style='float: left;' alt="R" height="300">
				<p>GAME description goes here Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac nulla at arcu egestas convallis eget id odio. Curabitur magna felis, congue quis pretium id, pulvinar sed turpis. Praesent ac tortor tortor. In hac habitasse platea dictumst. Morbi fringilla sapien in lectus ultrices, quis varius sapien condimentum. Vivamus fringilla condimentum risus, nec egestas libero sagittis nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac nulla at arcu egestas convallis eget id odio. Curabitur magna felis, congue quis pretium id, pulvinar sed turpis. Praesent ac tortor tortor. In hac habitasse platea dictumst. Morbi fringilla sapien in lectus ultrices, quis varius sapien condimentum. Vivamus fringilla condimentum risus, nec egestas libero sagittis nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi.</p>
			
			<br/>	
			<tr><td colspan="2" style="text-align:center; border-top: none;"> <img src="./img/scores.png" style="float: right;" alt="" height="190" class="u-max-full-width rating"></td></tr>
			 <!-- Score table
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <div class="row">
      <table class="u-full-width">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>


            <td class="score category">Frame rate</td>
            <td class="score description">
              <label for="fps:7.2">
                <input name="fps" type="radio" id="fps:7.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="fps:7.0">
                <input name="fps" type="radio" id="fps:7.0">
                <span class="label-body">May be capped at 30fps</span>
              </label>
            </td>
            <td class="score description">
              <label for="fps:7.1">
                <input name="fps" type="radio" id="fps:7.1">
                <span class="label-body">May be capped at 60fps</span>
              </label>
            </td>
            <td class="score description">
              <label for="fps:7.2">
                <input name="fps" type="radio" id="fps:7.2">
                <span class="label-body">Capped at 60fps</span>
              </label>
            </td>
            <td class="score description">
              <label for="fps:7.3">
                <input name="fps" type="radio" id="fps:7.3">
                <span class="label-body">Capped at 60fps, potentially limitless</span>
              </label>
            </td>
            <td class="score description">
              <label for="fps:7.4">
                <input name="fps" type="radio" id="fps:7.4">
                <span class="label-body">Limitless</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Resolution</td>
            <td class="score description">
              <label for="res:7.2">
                <input name="res" type="radio" id="res:7.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="res:7.0">
                <input name="res" type="radio" id="res:7.0">
                <span class="label-body">Does not support 1080p or higher</span>
              </label>
            </td>
            <td class="score description">
              <label for="res:7.1">
                <input name="res" type="radio" id="res:7.1">
                <span class="label-body">May support up to 1080p</span>
              </label>
            </td>
            <td class="score description">
              <label for="res:7.2">
                <input name="res" type="radio" id="res:7.2">
                <span class="label-body">Supports 1080p. No multi-monitor support</span>
              </label>
            </td>
            <td class="score description">
              <label for="res:7.3">
                <input name="res" type="radio" id="res:7.3">
                <span class="label-body">Supports 1080p, may include multi-monitor support</span>
              </label>
            </td>
            <td class="score description">
              <label for="res:7.4">
                <input name="res" type="radio" id="res:7.4">
                <span class="label-body">4K or beyond, may include multi-monitor support</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Optimized</td>
            <td class="score description">
              <label for="opt:8.2">
                <input name="opt" type="radio" id="opt:8.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="opt:8.0">
                <input name="opt" type="radio" id="opt:8.0">
                <span class="label-body">Poorly</span>
              </label>
            </td>
            <td class="score description">
              <label for="opt:8.1">
                <input name="opt" type="radio" id="opt:8.1">
                <span class="label-body">Passable</span>
              </label>
            </td>
            <td class="score description">
              <label for="opt:8.2">
                <input name="opt" type="radio" id="opt:8.2">
                <span class="label-body">Good</span>
              </label>
            </td>
            <td class="score description">
              <label for="opt:8.3">
                <input name="opt" type="radio" id="opt:8.3">
                <span class="label-body">Great</span>
              </label>
            </td>
            <td class="score description">
              <label for="opt:8.4">
                <input name="opt" type="radio" id="opt:8.4">
                <span class="label-body">Glorious!</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Mod support</td>
            <td class="score description">
              <label for="mod:3.2">
                <input name="mod" type="radio" id="mod:3.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="mod:3.0">
                <input name="mod" type="radio" id="mod:3.0">
                <span class="label-body">No support, mods may result in online bans</span>
              </label>
            </td>
            <td class="score description">
              <label for="mod:3.1">
                <input name="mod" type="radio" id="mod:3.1">
                <span class="label-body">Possible unofficial support, may be heavily restricted</span>
              </label>
            </td>
            <td class="score description">
              <label for="mod:3.2">
                <input name="mod" type="radio" id="mod:3.2">
                <span class="label-body">May not have official support, possibly restricted to cosmetic changes</span>
              </label>
            </td>
            <td class="score description">
              <label for="mod:3.3">
                <input name="mod" type="radio" id="mod:3.3">
                <span class="label-body">Some support, possibly restricted to cosmetic changes</span>
              </label>
            </td>
            <td class="score description">
              <label for="mod:3.4">
                <input name="mod" type="radio" id="mod:3.4">
                <span class="label-body">Complete support</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Servers</td>
            <td class="score description">
              <label for="srv:5.2">
                <input name="srv" type="radio" id="srv:5.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="srv:5.0">
                <input name="srv" type="radio" id="srv:5.0">
                <span class="label-body">Possibly weak, unreliable servers</span>
              </label>
            </td>
            <td class="score description">
              <label for="srv:5.1">
                <input name="srv" type="radio" id="srv:5.1">
                <span class="label-body">Possibly weak servers, but occasionally reliable</span>
              </label>
            </td>
            <td class="score description">
              <label for="srv:5.2">
                <input name="srv" type="radio" id="srv:5.2">
                <span class="label-body">Possibly some server issues at high volume, but no options available</span>
              </label>
            </td>
            <td class="score description">
              <label for="srv:5.3">
                <input name="srv" type="radio" id="srv:5.3">
                <span class="label-body">Acceptable servers with dedicated or custom servers optional</span>
              </label>
            </td>
            <td class="score description">
              <label for="srv:5.4">
                <input name="srv" type="radio" id="srv:5.4">
                <span class="label-body">Strong servers with dedicated or custom servers optional</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">DLC</td>
            <td class="score description">
              <label for="dlc:4.2">
                <input name="dlc" type="radio" id="dlc:4.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="dlc:4.0">
                <input name="dlc" type="radio" id="dlc:4.0">
                <span class="label-body">Possible “Day 1 DLC”, affects entire game balance</span>
              </label>
            </td>
            <td class="score description">
              <label for="dlc:4.1">
                <input name="dlc" type="radio" id="dlc:4.1">
                <span class="label-body">Possible “Day 1 DLC”, affects game balance online</span>
              </label>
            </td>
            <td class="score description">
              <label for="dlc:4.2">
                <input name="dlc" type="radio" id="dlc:4.2">
                <span class="label-body">Possible “Day 1 DLC”, does not affect game balance online</span>
              </label>
            </td>
            <td class="score description">
              <label for="dlc:4.3">
                <input name="dlc" type="radio" id="dlc:4.3">
                <span class="label-body">No “Day 1 DLC”, or DLC is purely cosmetic</span>
              </label>
            </td>
            <td class="score description">
              <label for="dlc:4.4">
                <input name="dlc" type="radio" id="dlc:4.4">
                <span class="label-body">No “Day 1 DLC”, or DLC is free</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Glitches</td>
            <td class="score description">
              <label for="gli:6.2">
                <input name="gli" type="radio" id="gli:6.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="gli:6.0">
                <input name="gli" type="radio" id="gli:6.0">
                <span class="label-body">Possible excess of glitches, likely game-breaking</span>
              </label>
            </td>
            <td class="score description">
              <label for="gli:6.1">
                <input name="gli" type="radio" id="gli:6.1">
                <span class="label-body">Possible excess of glitches, but not game-breaking</span>
              </label>
            </td>
            <td class="score description">
              <label for="gli:6.2">
                <input name="gli" type="radio" id="gli:6.2">
                <span class="label-body">Some glitches, but usually not game-breaking</span>
              </label>
            </td>
            <td class="score description">
              <label for="gli:6.3">
                <input name="gli" type="radio" id="gli:6.3">
                <span class="label-body">Few glitches, but rarely do they affect enjoyment</span>
              </label>
            </td>
            <td class="score description">
              <label for="gli:6.4">
                <input name="gli" type="radio" id="gli:6.4">
                <span class="label-body">Nearly none, or to a limited and rare amount</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Settings</td>
            <td class="score description">
              <label for="set:4.2">
                <input name="set" type="radio" id="set:4.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="set:4.0">
                <input name="set" type="radio" id="set:4.0">
                <span class="label-body">None, or very limited settings</span>
              </label>
            </td>
            <td class="score description">
              <label for="set:4.1">
                <input name="set" type="radio" id="set:4.1">
                <span class="label-body">Limited settings</span>
              </label>
            </td>
            <td class="score description">
              <label for="set:4.2">
                <input name="set" type="radio" id="set:4.2">
                <span class="label-body">Limited settings, short range on video settings</span>
              </label>
            </td>
            <td class="score description">
              <label for="set:4.3">
                <input name="set" type="radio" id="set:4.3">
                <span class="label-body">Acceptable settings, medium range on video settings</span>
              </label>
            </td>
            <td class="score description">
              <label for="set:4.4">
                <input name="set" type="radio" id="set:4.4">
                <span class="label-body">Full settings, wide range on video settings</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">Controls</td>
            <td class="score description">
              <label for="ctl:3.2">
                <input name="ctl" type="radio" id="ctl:3.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="ctl:3.0">
                <input name="ctl" type="radio" id="ctl:3.0">
                <span class="label-body">Un-configurable controls, no gamepad support</span>
              </label>
            </td>
            <td class="score description">
              <label for="ctl:3.1">
                <input name="ctl" type="radio" id="ctl:3.1">
                <span class="label-body">Sensitivity options, no control mapping, no gamepad support</span>
              </label>
            </td>
            <td class="score description">
              <label for="ctl:3.2">
                <input name="ctl" type="radio" id="ctl:3.2">
                <span class="label-body">Keyboard remap-able, gamepad support, sensitivity options</span>
              </label>
            </td>
            <td class="score description">
              <label for="ctl:3.3">
                <input name="ctl" type="radio" id="ctl:3.3">
                <span class="label-body">All devices remap-able, gamepad support, sensitivity options</span>
              </label>
            </td>
            <td class="score description">
              <label for="ctl:3.4">
                <input name="ctl" type="radio" id="ctl:3.4">
                <span class="label-body">All devices remap-able, alternate controls, gamepad support, sensitivity options, automatic input detectoin</span>
              </label>
            </td>
          </tr>


          <tr>
            <td class="score category">DRM</td>
            <td class="score description">
              <label for="drm:3.2">
                <input name="drm" type="radio" id="drm:3.2">
                <span class="label-body">N/A</span>
              </label>
            </td>
            <td class="score description">
              <label for="drm:3.0">
                <input name="drm" type="radio" id="drm:3.0">
                <span class="label-body">Limited installs, constant online connection required
                  <sup class="hoverbox parent">★
                    <span class="hoverbox child">does not apply to online multiplayer games for obvious reasons</span>
                  </sup>
                </span>
              </label>
            </td>
            <td class="score description">
              <label for="drm:3.1">
                <input name="drm" type="radio" id="drm:3.1">
                <span class="label-body">Limited installs, online check-ins</span>
              </label>
            </td>
            <td class="score description">
              <label for="drm:3.2">
                <input name="drm" type="radio" id="drm:3.2">
                <span class="label-body">Online check-ins</span>
              </label>
            </td>
            <td class="score description">
              <label for="drm:3.3">
                <input name="drm" type="radio" id="drm:3.3">
                <span class="label-body">Unlimited installs, available offline</span>
              </label>
            </td>
            <td class="score description">
              <label for="drm:3.4">
                <input name="drm" type="radio" id="drm:3.4">
                <span class="label-body">No DRM</span>
              </label>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Footer
    ________________________________________________ -->
    <div class="row">
      <div class="u-full-width" style="margin-top: 0%">
        <footer>
          <p>
            <!-- Based on <a href="http://www.reddit.com/r/pcmasterrace">/r/PCMR</a> user ratings.
            Credits go to <a href="http://www.reddit.com/user/BallisticGE0RGE">/u/BallisticGE0RGE</a> for the images.
            Original thread <a href="http://redd.it/3b6eic">here</a> -->
          </p>
        </footer>
      </div>
    </div>
<!--
  </div>

   End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– 

			<table class="table">
				<th>*</th><th>Individual reviews</th>
				<tr><td style="width: 25px"><img src="img/badges/r_tiny.jpg" alt="R" height="20"></td><td>review by /u/pedro19</td></tr>
			</table>
			</div>
		</div>-->
		<?php include("res/footer.php"); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="./PCMR Rating System calculator_files/jquery.min.js"></script>
        <script src="./PCMR Rating System calculator_files/main.js"></script>
		<script src="js/main.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="Jquery-1.4.2-min.js"></script>
		<script src="FloatingHeader.js"></script>
	</body>
</html>
